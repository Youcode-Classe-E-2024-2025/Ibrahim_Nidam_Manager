CREATE DATABASE IF NOT EXISTS manager_db;

USE manager_db;

CREATE TABLE roles (
    role_id varchar(255) PRIMARY KEY,
    role varchar(255)
);

CREATE TABLE users (
    user_id varchar(255) PRIMARY KEY,
    role_id varchar(255),
    username varchar(255),
    email varchar(255),
    password_hash varchar(255),
    created_at datetime,
    is_active boolean
);

CREATE TABLE movies (
    movie_id varchar(255) PRIMARY KEY,
    title varchar(255),
    release_date date,
    director varchar(255),
    synopsis text,
    avg_rating float,
    created_at datetime,
    is_active boolean
);

CREATE TABLE archives (
    archive_id varchar(255) PRIMARY KEY,
    original_id varchar(255),
    archived_data json,
    archived_at datetime,
    archived_by_user_id varchar(255)
);

CREATE TABLE watchlists (
    watchlist_id varchar(255) PRIMARY KEY,
    user_id varchar(255) UNIQUE,
    name varchar(255),
    created_at datetime
);

CREATE TABLE watchlist_movies (
    watchlist_id varchar(255),
    movie_id varchar(255),
    is_active boolean
);

CREATE TABLE reviews (
    review_id varchar(255) PRIMARY KEY,
    user_id varchar(255),
    movie_id varchar(255),
    rating float,
    content text,
    created_at datetime,
    is_active boolean
);

CREATE TABLE genres (
    genre_id varchar(255) PRIMARY KEY,
    name varchar(255),
    description text
);

CREATE TABLE movie_genres (
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
