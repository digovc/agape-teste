CREATE TABLE account (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    login VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    enabled BOOL,
    admin BOOL
);

INSERT INTO
    account (
        name,
        login,
        email,
        password,
        enabled,
        admin
    )
VALUES
    (
        'Rodrigo Daros',
        'digovc',
        'rodrigo.conspena@gmail.com',
        '123@secret',
        true,
        true
    );