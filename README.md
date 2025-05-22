# Backend Challenge - Magazord

This project was developed as part of the backend developer test for **Magazord**. It is a complete contact and person management system using pure PHP with Doctrine ORM, following the MVC pattern and good development practices.

---

⚠️ Note: Sensitive files such as .env and database seed scripts are intentionally included in this repository to simplify usage and testing.

## 🚀 Technologies Used

* **PHP 8.2**
* **Doctrine ORM 2.10**
* **Composer**
* **MySQL 8.0**
* **Apache**
* **Docker / Docker Compose**
* **HTML, CSS, JavaScript**
* **PHPUnit** for automated testing

---

## 📁 Folder Structure

```text
challenge_magazord/
├── app/
│   ├── Controller/        # Controllers (PersonController, ContactController)
│   ├── Service/           # Business logic
│   ├── Repository/        # Persistence layer (Doctrine)
│   └── View/              # Presentation layer (HTML/CSS)
├── src/Entity/            # Doctrine entities (Person, Contact)
├── config/                # DB config and bootstrap
├── public/                # Application entry point
├── tests/                 # Unit tests (PHPUnit)
├── docker/                # Docker files
├── .env                   # Environment variables
├── Dockerfile             # PHP custom container image
├── docker-compose.yml     # Container orchestration
├── composer.json          # PHP dependencies
└── README.md              # This file
```

---

## ⚙️ How to Install the Project

### Requirements:

* Docker and Docker Compose installed

### Steps:

```bash
# 1. Clone the repository
$ git clone https://github.com/lilicoAlmeida/challenge_bravoo.git
$ cd challenge_bravoo

# 2. Build and run the containers
$ docker-compose up --build

# 3. Open in your browser
http://localhost:8000
```

The database will be automatically initialized using `docker/mysql/init.sql`.

---

## 📲 How to Use the System

The system has a simple and intuitive web interface with three main areas: **Dashboard**, **People**, and **Contacts**.

### 🔍 Dashboard

* Go to `http://localhost:8000`
* Use the search bar to look for people or contacts by name
* View the results displayed in **cards**

### 👤 People

* Click on **People** in the top menu
* You will see all registered people with their name and CPF
* Use the search to filter by name
* Click `View` to see more details

#### Add New Person

* Click `+ Add New Person`
* Fill in **Name** and **CPF**
* Click `Save` to submit

#### Edit Person

* Click `View` on the desired person
* Click `Edit`, modify the data, and click `Update`

#### Delete Person

* On the person details page, click `Delete`

### 📞 Contacts

* Click on **Contacts** in the top menu
* You’ll see all registered contacts linked to people
* Each contact has a **type** (Phone or Email) and description

#### Add New Contact

* Click `+ Add New Contact`
* Fill in:

  * **Description**
  * **Type** (Phone or Email)
  * **Linked person**
* Click `Save`

#### Edit Contact

* Click `View` on the contact card
* Click `Edit`, modify the data, and click `Update`

#### Delete Contact

* On the contact details page, click `Delete`

### ✅ Visual Summary

* All actions are clearly marked with buttons (View, Edit, Delete)
* Sections are well separated by type and relationship (contacts linked to people)

---

## 🔄 Execution Flow (MVC Architecture)

1. The app is accessed via `public/index.php`
2. The router determines which `Controller` to call
3. The `Controller` invokes the `Service` with business logic
4. The `Service` interacts with `Repositories` via Doctrine
5. The final result is rendered via `View`

Example:

```php
public/index.php → PersonController@create → PersonService@create → PersonRepository@save
```

---

## 🧪 Automated Testing

The project includes automated tests using **PHPUnit**, located in `tests/Service`.

### Run the tests:

```bash
# Inside the container:
docker exec -it challenge_magazord_app composer test
```

### Test Coverage

* `PersonServiceTest.php` → Tests create, update, delete, and search of people
* `ContactServiceTest.php` → Tests contact operations and person relationships

---

## 📅 Author

Developed by **Lincoln Almeida**
📧 Email: [lincolnalmeida.sp@gmail.com](mailto:lincolnalmeida.sp@gmail.com)
🔗 LinkedIn: [https://www.linkedin.com/in/lincoln-almeida-fullstack/](https://www.linkedin.com/in/lincoln-almeida-fullstack/)
💻 GitHub: [https://github.com/lilicoAlmeida/challenge\_bravoo](https://github.com/lilicoAlmeida/challenge_bravoo)

---

## ✉️ Contact

For more information, reach out via email or LinkedIn above.

---

## ✅ Conclusion

This project was built with a focus on clean architecture, good practices, and the required technologies such as Doctrine, Docker, PHPUnit, and plain PHP. It demonstrates backend development skills with professional structure and implementation.
