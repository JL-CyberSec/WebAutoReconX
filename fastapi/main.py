from fastapi import FastAPI
import scan as scan

app = FastAPI()

@app.get("/system-info")
def get_system_info():
    return scan.get_system_info()

@app.get("/interfaces")
def get_interfaces():
    return scan.get_interfaces()

@app.get("/firewall")
def get_firewall():
    return scan.get_firewall()

@app.get("/hosts")
def get_hosts():
    return scan.get_hosts()
