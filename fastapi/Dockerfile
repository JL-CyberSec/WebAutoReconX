# Use an official Python runtime as a parent image
FROM python:3.11-slim

# Set work directory
WORKDIR /app

# Install system dependencies for building Python packages and nmap
RUN apt-get update && \
    apt-get install -y build-essential python3-dev nmap && \
    rm -rf /var/lib/apt/lists/*

# Install FastAPI, Uvicorn, and other Python dependencies
RUN pip install fastapi uvicorn \
    psutil \
    netifaces \
    requests \
    python-nmap

# Copy FastAPI app files
COPY . .

# Expose FastAPI port
EXPOSE 8000

# Run FastAPI with Uvicorn, enabling auto-reload for development
CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "8000", "--reload"]
