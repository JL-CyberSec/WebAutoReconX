import socket
import platform
import requests
import psutil
import subprocess
import json
import netifaces
import nmap

def get_system_info():
    hostname = socket.gethostname()
    ip_address = socket.gethostbyname(hostname)
    name = platform.system()
    version = platform.release()
    machine = platform.machine()

    return {
        'name': name,
        'version': version,
        'hostname': hostname,
        'architecture': machine,
        'ip_address': ip_address
    }

def get_interfaces():
    data = {}

    try:
        response = requests.get('https://api.ipify.org?format=json', timeout=2)
        data['public_ip'] = response.json()['ip']
        data['internet_access'] = "Yes"
    except:
        data['public_ip'] = 'Unavailable'
        data['internet_access'] = "No"

    interfaces = psutil.net_if_addrs()

    for interface_name, addresses in interfaces.items():
        stats = psutil.net_if_stats()

        data[interface_name] = {}

        if interface_name in stats:
            is_up = stats[interface_name].isup
            iface_stats = stats[interface_name]
            duplex = 'Half' if iface_stats.duplex == psutil.NIC_DUPLEX_HALF else 'Unknown'

            data[interface_name]['status'] = 'Up' if is_up else 'Down'
            data[interface_name]['is_vpn'] = 'Yes' if is_vpn(interface_name) else 'No'
            data[interface_name]['speed'] = iface_stats.speed
            data[interface_name]['duplex'] = 'Full' if iface_stats.duplex == psutil.NIC_DUPLEX_FULL else duplex
            data[interface_name]['mtu'] = iface_stats.mtu

        io_counters = psutil.net_io_counters(pernic=True)

        if interface_name in io_counters:
            iface_io = io_counters[interface_name]
            data[interface_name]['bytes_sent'] = iface_io.bytes_sent
            data[interface_name]['bytes_received'] = iface_io.bytes_recv
            data[interface_name]['packets_sent'] = iface_io.packets_sent
            data[interface_name]['packets_received'] = iface_io.packets_recv
            data[interface_name]['errors_in'] = iface_io.errin
            data[interface_name]['errors_out'] = iface_io.errout
            data[interface_name]['drop_in'] = iface_io.dropin
            data[interface_name]['drop_out'] = iface_io.dropout

        for address in addresses:
            if address.family == socket.AF_INET:
                data[interface_name]['ipv4_address'] = address.address
                data[interface_name]['netmask'] = address.netmask
                data[interface_name]['broadcast'] = address.broadcast
            elif address.family == socket.AF_INET6:
                data[interface_name]['ipv6_address'] = address.address
                data[interface_name]['netmask'] = address.netmask
                data[interface_name]['broadcast'] = address.broadcast
            elif address.family == psutil.AF_LINK:
                data[interface_name]['mac_address'] = address.address

    return data

def is_vpn(interface_name):
    vpn_keywords = ["vpn", "tun", "tap", "ppp", "ipsec", "pptp", "l2tp", "openvpn"]
    return any(keyword in interface_name.lower() for keyword in vpn_keywords)

def get_firewall():
    output = get_iptables()
    parsed_rules = parse_iptables(output)
    return json.dumps(parsed_rules, indent=2)

def get_iptables():
    result = subprocess.run(["sudo", "iptables", "-L"], capture_output=True, text=True)
    return result.stdout

def parse_iptables(output):
    lines = output.splitlines()
    chains = []
    current_chain = None

    for line in lines:
        if line.startswith("Chain"):
            parts = line.split()
            current_chain = {
                "name": parts[1],
                "policy": parts[3],
                "packets": parts[4],
                "bytes": parts[6],
                "rules": []
            }
            chains.append(current_chain)
        elif line and current_chain:
            parts = line.split()
            rule = {
                "target": parts[0],
                "prot": parts[1],
                "opt": parts[2],
                "source": parts[3],
                "destination": parts[4],
            }
            current_chain["rules"].append(rule)

    return chains

http_hosts = []

def get_hosts():
    data = {}
    scan_timing = 3
    active_ip_addresses = get_active_ip_addresses()

    if active_ip_addresses:
        for ip in active_ip_addresses:
            data[ip] = {
                'devices_found': {}
            }

            nm = nmap.PortScanner()
            structured_hosts = {}

            nm.scan(hosts=f"{ip}/24", arguments=f"-T{scan_timing} -sP")

            for host in nm.all_hosts():
                if host not in data[ip]['devices_found']:
                    data[ip]['devices_found'][host] = {}

            for host in data[ip]['devices_found']:
                #data[ip]['devices_found'][host] = {}

                nm.scan(hosts=host, arguments=f"-T{scan_timing} -O -sV")

                for _host in nm.all_hosts():
                    data[ip]['devices_found'][host]['host_status'] = nm[_host].state()
                    data[ip]['devices_found'][host]['hostname'] = nm[_host].hostname() if nm[_host].hostname() else 'Unknown'

        #if http_hosts:
            #files.show(http_hosts)
    else:
        return {'message': "No active IP addresses found with connection."}

    return data

def get_active_ip_addresses():
    active_ips = []

    try:
        interfaces = netifaces.interfaces()
        interfaces = [iface for iface in interfaces if iface != 'lo']

        for interface in interfaces:
            addresses = netifaces.ifaddresses(interface).get(socket.AF_INET)

            if addresses:
                for address_info in addresses:
                    if 'addr' in address_info:
                        ip = address_info['addr']
                        active_ips.append(ip)

        return active_ips if active_ips else None

    except Exception as e:
        return None

def get_port_type(port: int):
    insecure_ports = [21, 23, 25, 80, 110, 143, 389, 445, 1433, 3306, 3389, 8000]
    return 'INSEC' if port in insecure_ports else ''

def detect_http_service(ip, port):
    try:
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.settimeout(2)
        s.connect((ip, port))
        s.send(b'GET / HTTP/1.0\r\n\r\n')
        banner = s.recv(1024)
        s.close()

        if b'HTTP' in banner:
            if b'HTTPS' in banner or port == 443:
                http_hosts.append((ip, port, 'https'))
            else:
                http_hosts.append((ip, port, 'http'))

    except (socket.timeout, socket.error):
        return False
