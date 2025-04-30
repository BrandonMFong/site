FROM ubuntu:latest

# Update package lists
RUN apt-get update

# Install any necessary runtime dependencies for your C++ application
# You might need libraries like libstdc++, or others depending on your code.
# This is a common one, but adjust as needed.
RUN apt-get install -y --no-install-recommends libstdc++6 && rm -rf /var/lib/apt/lists/*

# Create a directory for your application inside the container
WORKDIR /app

# Create a directory for HTML content in the container
RUN mkdir -p /app/root

# Copy your HTML content into the container
COPY root /app/root

# Copy your compiled C++ binary into the container
COPY external/http/bin/release/http /app/

# Make the binary executable (just in case)
RUN chmod +x /app/http

# Expose the port your HTTP server listens on (replace 8080 if different)
EXPOSE 8081

# Command to run your HTTP server
CMD ["/app/http", "-root", "/app/root", "-port", "8081"]
