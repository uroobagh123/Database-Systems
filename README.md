# Database Systems

This folder contains all the necessary files, schemas, and scripts related to the project's database.

## 📂 Contents

- **SQL Scripts** — Contains `.sql` files for creating, updating, and managing the database structure.
- **Seed Data** — Sample data for initializing the database.
- **Migrations** — Step-by-step updates to the database schema for version control.
- **Config Files** — Database connection settings and environment configurations.

## 🛠️ Setup Instructions

1. **Install Database**
   - Ensure you have the required database engine installed (e.g., MySQL, PostgreSQL, MongoDB, etc.).

2. **Run Migrations**
   ```bash
   # Example for running SQL migrations
   mysql -u username -p database_name < migrations/init.sql
