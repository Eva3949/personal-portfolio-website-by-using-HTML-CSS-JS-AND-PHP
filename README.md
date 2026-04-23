# Samuel Tenkir - Portfolio Website

A modern, responsive portfolio website built with HTML, CSS, JavaScript, and PHP backend with MySQL database.

## Features

- **Frontend**: Pure HTML, CSS, and JavaScript (no frameworks)
- **Backend**: PHP with MySQL database
- **Responsive Design**: Works on all devices
- **Admin Panel**: Add/manage projects dynamically
- **Blue & Black Theme**: Professional color scheme
- **Static Sections**: No animations from About section onwards

## Setup Instructions (XAMPP)

### 1. Database Setup

1. Start XAMPP and ensure Apache and MySQL are running
2. Open phpMyAdmin (http://localhost/phpmyadmin)
3. Import the `database_setup.sql` file to create the database and table
4. Or manually run the SQL commands in the file

### 2. File Structure

Place all files in your XAMPP htdocs folder (usually `C:/xampp/htdocs/portfolio/`):

```
portfolio/
├── index.html              # Main portfolio page
├── admin.html              # Admin panel to add projects
├── styles.css              # Styling
├── script.js               # Frontend JavaScript
├── config.php              # Database configuration
├── get_projects.php        # API to fetch projects
├── add_project.php         # API to add new projects
├── database_setup.sql      # Database setup script
├── picture.png             # Profile picture
└── README.md               # This file
```

### 3. Access the Website

- **Portfolio**: http://localhost/portfolio/
- **Admin Panel**: http://localhost/portfolio/admin.html

### 4. Adding Projects

1. Go to the admin panel: http://localhost/portfolio/admin.html
2. Fill in the project details:
   - Project Title (required)
   - Project Description (required)
   - Image URL (required) - direct link to project image
   - Live Demo URL (optional)
   - GitHub URL (optional)
   - Technologies (required) - add at least one technology
3. Click "Add Project" to save to database

## Database Structure

The `projects` table contains:

```sql
CREATE TABLE projects (
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
```

## API Endpoints

### GET /get_projects.php
Returns all projects in JSON format:

```json
{
    "success": true,
    "projects": [
        {
            "id": 1,
            "title": "Project Title",
            "description": "Project description",
            "image_url": "https://example.com/image.jpg",
            "live_demo_url": "https://example.com/demo",
            "github_url": "https://github.com/user/project",
            "technologies": ["React", "Node.js", "MongoDB"],
            "created_at": "2024-01-01 12:00:00",
            "updated_at": "2024-01-01 12:00:00"
        }
    ],
    "count": 1
}
```

### POST /add_project.php
Adds a new project to the database.

Request body (JSON):
```json
{
    "title": "Project Title",
    "description": "Project description",
    "image_url": "https://example.com/image.jpg",
    "live_demo_url": "https://example.com/demo",
    "github_url": "https://github.com/user/project",
    "technologies": "React,Node.js,MongoDB"
}
```

Response:
```json
{
    "success": true,
    "message": "Project added successfully",
    "project_id": 123
}
```

## Customization

### Changing Colors

Edit the CSS variables in `styles.css`:

```css
:root {
    --primary-color: #0066CC;
    --primary-dark: #004499;
    --secondary-color: #003366;
    --accent-color: #0099FF;
    --text-dark: #000000;
    --text-light: #333333;
    --text-white: #FFFFFF;
    /* ... */
}
```

### Adding Sections

1. Add new sections to `index.html`
2. Style them in `styles.css`
3. Add navigation links to the navbar

### Database Configuration

Edit `config.php` to change database settings:

```php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'portfolio_db';
```

## Security Notes

- The admin panel is not password-protected (add authentication for production)
- Input validation and sanitization are implemented
- SQL injection prevention using prepared statements
- XSS prevention through output escaping

## Troubleshooting

### Database Connection Issues
- Ensure XAMPP MySQL is running
- Check database credentials in `config.php`
- Verify database name exists

### Projects Not Loading
- Check browser console for JavaScript errors
- Verify `get_projects.php` is accessible
- Check database connection

### Admin Panel Issues
- Ensure `add_project.php` has correct permissions
- Check CORS headers if accessing from different domains
- Verify JSON data format

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Server**: Apache (XAMPP)
- **Fonts**: Google Fonts (Inter)
- **Icons**: Font Awesome 6.4.0

## License

This project is open source and available under the MIT License.
