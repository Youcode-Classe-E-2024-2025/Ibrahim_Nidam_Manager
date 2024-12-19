CREATE DATABASE IF NOT EXISTS manager_db;

USE manager_db;

CREATE TABLE IF NOT EXISTS roles (
    role_id varchar(255) PRIMARY KEY,
    role varchar(255)
);

CREATE TABLE IF NOT EXISTS users (
    user_id varchar(255) PRIMARY KEY,
    role_id varchar(255),
    username varchar(255),
    email varchar(255) UNIQUE,
    password_hash varchar(255),
    created_at datetime DEFAULT CURRENT_TIMESTAMP, 
    is_active boolean DEFAULT FALSE 
);

CREATE TABLE IF NOT EXISTS movies (
    movie_id VARCHAR(255) PRIMARY KEY,
    title VARCHAR(255),
    release_date DATE,
    director VARCHAR(255),
    synopsis TEXT,
    avg_rating FLOAT DEFAULT 0.00,
    image_path VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP, 
    is_active BOOLEAN DEFAULT TRUE
);


CREATE TABLE IF NOT EXISTS archives (
    archive_id varchar(255) PRIMARY KEY,
    original_id varchar(255),
    archived_data json,
    archived_at datetime DEFAULT CURRENT_TIMESTAMP, 
    archived_by_user_id varchar(255)
);

CREATE TABLE IF NOT EXISTS watchlists (
    watchlist_id varchar(255) PRIMARY KEY,
    user_id varchar(255) UNIQUE,
    name varchar(255),
    created_at datetime DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE IF NOT EXISTS watchlist_movies (
    watchlist_id varchar(255),
    movie_id varchar(255)
);

CREATE TABLE IF NOT EXISTS reviews (
    review_id varchar(255) PRIMARY KEY,
    user_id varchar(255),
    movie_id varchar(255),
    rating float,
    content text,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    is_active boolean DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS genres (
    genre_id varchar(255) PRIMARY KEY,
    name varchar(255)
);

CREATE TABLE IF NOT EXISTS movie_genres (
    movie_id varchar(255),
    genre_id varchar(255)
);

ALTER TABLE users ADD FOREIGN KEY (role_id) REFERENCES roles (role_id);

ALTER TABLE watchlists ADD FOREIGN KEY (user_id) REFERENCES users (user_id);

ALTER TABLE watchlist_movies ADD FOREIGN KEY (watchlist_id) REFERENCES watchlists (watchlist_id);

ALTER TABLE watchlist_movies ADD FOREIGN KEY (movie_id) REFERENCES movies (movie_id);

ALTER TABLE reviews ADD FOREIGN KEY (user_id) REFERENCES users (user_id);

ALTER TABLE reviews ADD FOREIGN KEY (movie_id) REFERENCES movies (movie_id);

ALTER TABLE movie_genres ADD FOREIGN KEY (movie_id) REFERENCES movies (movie_id);

ALTER TABLE movie_genres ADD FOREIGN KEY (genre_id) REFERENCES genres (genre_id);

ALTER TABLE archives ADD FOREIGN KEY (archived_by_user_id) REFERENCES users (user_id);

INSERT IGNORE INTO roles (role_id, role) VALUES ('admin', 'admin');

INSERT IGNORE INTO users (user_id, role_id, username, email, password_hash, is_active) 
VALUES ('admin', 'admin', 'admin', 'a@g.com', '$2a$12$4tU0ZnyeCeQMgzVRc8TBUOAIuJsTwaBkdqZKPWZPGfpzXs/M92Nka', TRUE);

INSERT IGNORE INTO genres (genre_id, name) VALUES 
('genre-1234567-1678901234567', 'Action'),
('genre-2345678-1678901234568', 'Adventure'),
('genre-3456789-1678901234569', 'Animation'),
('genre-4567890-1678901234570', 'Biography'),
('genre-5678901-1678901234571', 'Comedy'),
('genre-6789012-1678901234572', 'Crime');
