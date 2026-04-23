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
('E-Commerce Platform', 'A full-stack e-commerce solution with real-time inventory management, secure payment processing, and responsive design.', 'https://reeaglobal.com/reeacnt/uploads/2023/01/Why-Would-You-Need-a-Custom-eCommerce-Platform-Blog-Cover.png', 'https://evadevstudio.com', 'https://github.com/Eva3949/', 'React,Node.js,MongoDB,Stripe'),
('Task Management App', 'A collaborative task management application with real-time updates, drag-and-drop functionality, and team collaboration features.', 'https://img.freepik.com/free-vector/task-management-app_52683-44675.jpg?semt=ais_hybrid&w=740&q=80', 'https://evadevstudio.com', 'https://github.com/Eva3949/', 'Vue.js,Firebase,Vuex,Tailwind'),
('Analytics Dashboard', 'A comprehensive analytics dashboard with data visualization, real-time metrics, and customizable reporting features.', 'https://img.freepik.com/free-vector/user-panel-template-infographic-dashboard_23-2148378206.jpg?semt=ais_hybrid&w=740&q=80', 'https://evadevstudio.com', 'https://github.com/Eva3949/', 'React,D3.js,Python,PostgreSQL');
