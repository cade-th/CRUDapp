#!/bin/bash

# Grant execute permissions
chmod +x docker-compose.yml

# Stop containers
docker-compose down

# Build containers
docker-compose build
