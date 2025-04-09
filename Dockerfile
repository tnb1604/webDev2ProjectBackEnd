# Use Docker Compose to build and run the app
FROM docker/compose:latest

WORKDIR /app

# Copy the necessary files
COPY . .

# Default command to run Docker Compose
CMD ["docker-compose", "up"]
