-- Portfolio Database Setup for XAMPP
-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

-- Create projects table
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    live_demo_url VARCHAR(500),
    github_url VARCHAR(500),
    technologies TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data for testing
INSERT INTO projects (title, description, image_url, live_demo_url, github_url, technologies) VALUES
('E-Commerce Platform', 'A full-stack e-commerce solution with real-time inventory management, secure payment processing, and responsive design.', 'https://via.placeholder.com/400x250/10B981/FFFFFF?text=E-Commerce', 'https://example.com/demo1', 'https://github.com/example/ecommerce', 'React,Node.js,MongoDB,Stripe'),
('Task Management App', 'A collaborative task management application with real-time updates, drag-and-drop functionality, and team collaboration features.', 'https://via.placeholder.com/400x250/F59E0B/FFFFFF?text=Task+Manager', 'https://example.com/demo2', 'https://github.com/example/taskmanager', 'Vue.js,Firebase,Vuex,Tailwind'),
('Analytics Dashboard', 'A comprehensive analytics dashboard with data visualization, real-time metrics, and customizable reporting features.', 'https://via.placeholder.com/400x250/EF4444/FFFFFF?text=Analytics+Dashboard', 'https://example.com/demo3', 'https://github.com/example/analytics', 'React,D3.js,Python,PostgreSQL');
