# SHcms

A modular PHP-based Content Management System with a unique plugin architecture.

## What is SHcms?

SHcms is built on a simple concept: **Rules + Plugins = Suite**, and **Suite + Config = Project**.

- **Core**: File structure and rules
- **Plugins**: Add features (Account, Cart, Translate, etc.)
- **Suite**: Combine plugins for a specific purpose (like a WebShop or School site)
- **Project**: Add your configuration (database, API keys) and go live

## Quick Start

1. Clone this repository
2. Point your web server to the folder
3. Add your configuration
4. Done!

## Requirements

- PHP 7.4+
- Apache with mod_rewrite
- MySQL (for plugins that need it)

## How Plugins Work

Each plugin provides two things:
1. **Admin Panel** - To manage the feature
2. **JSON Output** - For displaying data on your site

Example plugins:
- **Account** - User registration and login
- **Cart** - Shopping cart
- **Translate** - Multi-language support
- **Item** - Manage products or content

## Directory Structure

```
SHcms/
├── audio/sounds/    # Audio files
├── css/             # Stylesheets
├── img/             # Images
├── include/         # Core PHP files
├── js/              # JavaScript
├── .htaccess        # URL routing
└── index.php        # Main entry point
```

## Creating a Project

1. Pick a suite (or start with core)
2. Add required plugins
3. Configure database and API keys
4. Deploy

## Support

- Website: [sidhosting.net](https://sidhosting.net)
- Phone: +31 50 80 80 350
- Docs: [schools.sidhosting.net](https://schools.sidhosting.net)

## License

MIT License - Feel free to use and modify.

---

Built by SiDHOSTiNG
