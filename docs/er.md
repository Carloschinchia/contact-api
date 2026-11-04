# Modelo de datos de Contacts API

```mermaid
erDiagram
    USERS ||--o{ CONTACTS : "tiene"

    USERS {
        bigint id PK
        string name
        string email UK
        string password
        boolean is_active
    }

    CONTACTS {
        bigint id PK
        string name
        string phone_number
        bigint user_id FK
        timestamp created_at
        timestamp updated_at
    }