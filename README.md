
# ProductsManager

ProductsManager is a Laravel-based web application designed to manage products, categories, and sellers, with advanced filtering and export functionality. It includes a custom package, *products-manager*, which provides comprehensive features for managing products, applying filters, and exporting data in CSV format. The project also includes event-driven functionality such as logging filter activities and sending welcome emails.

## Features

- **Product, Category, and Seller Management**: Efficiently manage products, categories, and sellers.
- **Advanced Filtering**: Apply various filters with full-text search support.
- **CSV Export**: Export product data in bulk via CSV, with the ability to manage large datasets.
- **Event-Driven Functionality**: Logs filter activity and sends a welcome discount email on first filter use.
- **Testing**: Pest tests have been written to ensure the application works as expected.

## Installation

### Prerequisites

1. **PHP 8+**  
2. **MySQL**  
3. **Node.js (for front-end dependencies)**

### Setup

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/inovector.git
   cd inovector
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Install front-end dependencies:

   ```bash
   npm install
   ```

4. Set up your `.env` file:

   ```bash
   cp .env.example .env
   ```

   Configure the `.env` file with your database and email credentials. For email, Inovector uses **Mailtrap** for development.

5. Run migrations and seed the database:

   ```bash
   php artisan migrate --seed
   ```

6. Serve the application:

   ```bash
   php artisan serve
   ```

### Queue Driver

Inovector uses **database** as the queue driver for CSV export/import tasks. Ensure the `jobs` table exists by running:

```bash
php artisan queue:table
php artisan migrate
```

## Usage

After setting up the application, you can start using the product, category, and seller management features. Filters can be applied to narrow down search results, and CSV exports can be triggered from the product management dashboard.

### Filtering Logic

Inovector uses **Eloquent** queries for filtering and full-text search. The filtering activity is logged in the `filter_logs` table for tracking.

### Email Functionality

Emails are sent using **Mailtrap** for development. Ensure Mailtrap is set up in your `.env` file.

## Testing

Inovector comes with Pest tests for verifying functionality. You can run the tests with:

```bash
php artisan test
```

## Contributing

If you'd like to contribute to the project, feel free to fork the repository and create a pull request. Please ensure your contributions align with the project’s coding standards and include tests where applicable.

## License

This project is open-source and available under the [MIT License](LICENSE).
