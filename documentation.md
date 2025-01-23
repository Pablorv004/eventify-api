# 🎫 Eventify API Documentation 🎫

### Domain: https://eventify-api-knpmj.ondigitalocean.app/api

## 👤 Users

### 🟢 Register User
- **Endpoint:** `/register`
- **Method:** `POST`
- **Description:** Registers a new user.
- **Parameters:**
  | Name       | Type   | Description                |
  |------------|--------|----------------------------|
  | name       | string | User's name                |
  | email      | string | User's email               |
  | password   | string | User's password            |
  | c_password | string | Confirm password           |
  | role       | string | User's role ('o','u')      |
- **Output Data Type:** JSON
- **Output Codes:**
  | Code | Description               |
  |------|---------------------------|
  | 200  | User registered successfully |
  | 404  | Validation Error          |

  **We highly recommend to use Postman for testing endpoints**
  
- **Example with curl:**
  ```bash
  curl -X POST https://eventify-api-knpmj.ondigitalocean.app/api/register -d "name=John Doe&email=john@example.com&password=123456&c_password=123456&role=u"
  ```

### 🟢 Login User
- **Endpoint:** `/login`
- **Method:** `POST`
- **Description:** Logs in a user.
- **Parameters:**
  | Name     | Type   | Description      |
  |----------|--------|------------------|
  | email    | string | User's email     |
  | password | string | User's password  |
- **Output Data Type:** JSON
- **Output Codes:**
  | Code | Description               |
  |------|---------------------------|
  | 200  | User logged in successfully |
  | 401  | Unauthorized              |

  **We highly recommend to use Postman for testing endpoints**
  
- **Example:**
  ```bash
  curl -X POST https://eventify-api-knpmj.ondigitalocean.app/api/login -d "email=john@example.com&password=123456"
  ```

### 🟢 Logout User
- **Endpoint:** `/logout`
- **Method:** `POST`
- **Description:** Logs out a user.
- **Parameters:** None
- **Output Data Type:** JSON
- **Output Codes:**
  | Code | Description               |
  |------|---------------------------|
  | 200  | User logged out successfully |

  **We highly recommend to use Postman for testing endpoints**
  
- **Example:**
  ```bash
  curl -X POST https://eventify-api-knpmj.ondigitalocean.app/api/logout -H "Authorization: Bearer your_token"
  ```

### 🔵 Get Users
- **Endpoint:** `/users`
- **Method:** `GET`
- **Description:** Retrieves a list of users.
- **Parameters:** None
- **Output Data Type:** JSON. List of Users.
  | Name       | Type   | Description                |
  |------------|--------|----------------------------|
  | id         | int    | User's ID                  |
  | name       | string | User's name                |
  | email      | string | User's email               |
  | role       | string | User's role                |
  | created_at | date   | User's creation date       |
  | updated_at | date   | User's last update date    |
- **Output Codes:**
  | Code | Description               |
  |------|---------------------------|
  | 200  | Users retrieved successfully |

  **We highly recommend to use Postman for testing endpoints**
  
- **Example:**
  ```bash
  curl -X GET https://eventify-api-knpmj.ondigitalocean.app/api/users
  ```

### 🔵 Get User
- **Endpoint:** `/users/{id}`
- **Method:** `GET`
- **Description:** Retrieves a specific user.
- **Parameters:**
  | Name | Type   | Description      |
  |------|--------|------------------|
  | id   | string | User's ID        |
- **Output Data Type:** JSON
  | Name       | Type   | Description                |
  |------------|--------|----------------------------|
  | id         | int    | User's ID                  |
  | name       | string | User's name                |
  | email      | string | User's email               |
  | role       | string | User's role                |
  | created_at | date   | User's creation date       |
  | updated_at | date   | User's last update date    |
- **Output Codes:**
  | Code | Description               |
  |------|---------------------------|
  | 200  | User retrieved successfully |
  | 404  | User not found            |

  **We highly recommend to use Postman for testing endpoints**
  
- **Example:**
  ```bash
  curl -X GET https://eventify-api-knpmj.ondigitalocean.app/api/users/1
  ```

## 🎪 Events

### 🔵 Get Events
- **Endpoint:** `/events`
- **Method:** `GET`
- **Description:** Retrieves a list of events.
- **Parameters:** None
- **Output Data Type:** JSON
  | Name         | Type   | Description                |
  |--------------|--------|----------------------------|
  | id           | int    | Event's ID                 |
  | title        | string | Event title                |
  | description  | string | Event description          |
  | category_id  | int    | Category ID                |
  | location     | string | Event location             |
  | start_date   | date   | Event start date           |
  | end_date     | date   | Event end date             |
  | latitude     | float  | Event latitude             |
  | longitude    | float  | Event longitude            |
  | max_attendees| int    | Maximum attendees          |
  | price        | float  | Event price                |
  | image_url    | string | Event image URL            |
  | organizer_id | int    | Organizer's ID             |
  | created_at   | date   | Event's creation date      |
  | updated_at   | date   | Event's last update date   |
- **Output Codes:**
  | Code | Description               |
  |------|---------------------------|
  | 200  | Events retrieved successfully |

  **We highly recommend to use Postman for testing endpoints**
  
- **Example:**
  ```bash
  curl -X GET https://eventify-api-knpmj.ondigitalocean.app/api/events
  ```

### 🔵 Get Event
- **Endpoint:** `/events/{id}`
- **Method:** `GET`
- **Description:** Retrieves a specific event.
- **Parameters:**
  | Name | Type   | Description      |
  |------|--------|------------------|
  | id   | int    | Event's ID       |
- **Output Data Type:** JSON
  | Name         | Type   | Description                |
  |--------------|--------|----------------------------|
  | id           | int    | Event's ID                 |
  | title        | string | Event title                |
  | description  | string | Event description          |
  | category_id  | int    | Category ID                |
  | location     | string | Event location             |
  | start_date   | date   | Event start date           |
  | end_date     | date   | Event end date             |
  | latitude     | float  | Event latitude             |
  | longitude    | float  | Event longitude            |
  | max_attendees| int    | Maximum attendees          |
  | price        | float  | Event price                |
  | image_url    | string | Event image URL            |
  | organizer_id | int    | Organizer's ID             |
  | created_at   | date   | Event's creation date      |
  | updated_at   | date   | Event's last update date   |
- **Output Codes:**
  | Code | Description               |
  |------|---------------------------|
  | 200  | Event retrieved successfully |

  **We highly recommend to use Postman for testing endpoints**
  
- **Example:**
  ```bash
  curl -X GET https://eventify-api-knpmj.ondigitalocean.app/api/events/1
  ```

### 🟢 Create Event
- **Endpoint:** `/events`
- **Method:** `POST`
- **Description:** Creates a new event.
- **Parameters:**
  | Name         | Type   | Description                |
  |--------------|--------|----------------------------|
  | title        | string | Event title                |
  | description  | string | Event description          |
  | category_id  | int    | Category ID                |
  | location     | string | Event location             |
  | start_date   | date   | Event start date           |
  | end_date     | date   | Event end date             |
  | latitude     | float  | Event latitude             |
  | longitude    | float  | Event longitude            |
  | max_attendees| int    | Maximum attendees          |
  | price        | float  | Event price                |
  | image_file   | file   | Event image file (optional)|
- **Output Data Type:** JSON
- **Output Codes:**
  | Code | Description               |
  |------|---------------------------|
  | 200  | Event created successfully |
  | 404  | Validation Error          |

  **We highly recommend to use Postman for testing endpoints**
  
- **Example:**
  ```bash
  curl -X POST https://eventify-api-knpmj.ondigitalocean.app/api/events -d "title=Sample Event&description=This is a sample event&category_id=1&location=Sample Location&start_date=2023-10-01&end_date=2023-10-02&latitude=40.7128&longitude=-74.0060&max_attendees=100&price=50"
  ```

### 🟡 Update Event
- **Endpoint:** `/events/{id}`
- **Method:** `PUT`
- **Description:** Updates an existing event.
- **Parameters:**
  | Name         | Type   | Description                |
  |--------------|--------|----------------------------|
  | title        | string | Event title                |
  | description  | string | Event description          |
  | category_id  | int    | Category ID                |
  | location     | string | Event location             |
  | start_date   | date   | Event start date           |
  | end_date     | date   | Event end date             |
  | latitude     | float  | Event latitude             |
  | longitude    | float  | Event longitude            |
  | max_attendees| int    | Maximum attendees          |
  | price        | float  | Event price                |
  | image_file   | file   | Event image file (optional)|
- **Output Data Type:** JSON
- **Output Codes:**
  | Code | Description               |
  |------|---------------------------|
  | 200  | Event updated successfully |
  | 404  | Validation Error          |

  **We highly recommend to use Postman for testing endpoints**
  
- **Example:**
  ```bash
  curl -X PUT https://eventify-api-knpmj.ondigitalocean.app/api/events/1 -d "title=Updated Event&description=This is an updated event&category_id=1&location=Updated Location&start_date=2023-10-01&end_date=2023-10-02&latitude=40.7128&longitude=-74.0060&max_attendees=150&price=75"
  ```

### 🔴 Delete Event
- **Endpoint:** `/events/{id}`
- **Method:** `DELETE`
- **Description:** Deletes an event.
- **Parameters:**
  | Name | Type | Description |
  |------|------|-------------|
  | id   | int  | Event's ID  |
- **Output Data Type:** JSON
- **Output Codes:**
  | Code | Description               |
  |------|---------------------------|
  | 200  | Event deleted successfully |

  **We highly recommend to use Postman for testing endpoints**
  
- **Example:**
  ```bash
  curl -X DELETE https://eventify-api-knpmj.ondigitalocean.app/api/events/1
  ```
