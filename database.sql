-- Student Record database: contains only the students table.\nCREATE DATABASE IF NOT EXISTS student_record_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE student_record_db;

CREATE TABLE IF NOT EXISTS students (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    student_number VARCHAR(50) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100) NULL,
    last_name VARCHAR(100) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    birth_date DATE NOT NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(30) NULL,
    address TEXT NOT NULL,
    course VARCHAR(150) NOT NULL,
    year_level VARCHAR(30) NOT NULL,
    section VARCHAR(50) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY students_student_number_unique (student_number),
    KEY students_first_name_last_name_index (first_name, last_name),
    KEY students_course_index (course)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;