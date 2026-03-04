CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    course VARCHAR(100) NOT NULL,
    lesson VARCHAR(100),
    status VARCHAR(50) NOT NULL,
    
    building VARCHAR(100) NOT NULL,
    floor VARCHAR(50) NOT NULL,
    room VARCHAR(50) NOT NULL,
    
    term VARCHAR(100) NOT NULL,
    class_time TIME NOT NULL,
    
    image_logo VARCHAR(255) NULL,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);