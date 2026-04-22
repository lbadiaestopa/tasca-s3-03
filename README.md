# 🚥  ToDo List 
A lightweight task management application built with a custom Model-View-Controller (MVC) framework in PHP. The project focuses on clean architectural separation, basic CRUD operations, and a simple state management system using JSON for persistence.

<img width="1920" height="705" alt="Captura de pantalla 2026-04-22 a les 12 46 20" src="https://github.com/user-attachments/assets/ea3d1f18-33e8-464a-984f-c27b356ab345" />

## 🛠️  Tech Stack
**Back-end** 🧠
- PHP 8
- Custom MVC framework
- JSON-based persistence layer

**Front-end** 🎨
- HTML 5
- Tailwind CSS

## ✨  Features
- Create, edit and delete tasks
- Assign a state: pending, in progress, or completed
- Filter tasks by state

## 🚧  Setup
Follow these steps to run the project locally:

1. Clone the repository
```bash
https://github.com/lbadiaestopa/tasca-s3-03.git
```
2. Run the built-in PHP server
```bash
php -S localhost:8000 -t web
```
3. Open in your browser
```bash
http://localhost:8000
```
## 📁  Simplified Project Structure
```plaintext
tasca-s3-03/
├── app/
│   ├── controllers/
│   ├── models/
│   └── views/
├── web/
│   └── index.php
└── data/
    └── tasks.json
```
## 🎯  Learning Goals
This project was built to:

- Understand and implement the MVC architectural pattern
- Work with Tailwind CSS for rapid UI development
- Handle state management and filtering logic
