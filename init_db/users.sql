create table if not exists users(
    id int auto_increment primary key,
    username varchar(50) unique not null,
    email varchar(255) not null,
    password_hash varchar(255) not null,
    created_at datetime default current_timestamp
)

insert into users (username, email, password_hash) values ('admin', 'admin@admin.com', password_hash('admin123'));
