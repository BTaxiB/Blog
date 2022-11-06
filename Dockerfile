FROM ubuntu

# Set the working directory
WORKDIR /app

# Copy files from your host to your current working directory
COPY . .

# Run the application
RUN w