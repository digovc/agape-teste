CREATE TABLE account (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    login VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    isEnabled BOOL,
    isAdmin BOOL
);

CREATE TABLE session (
    accountId INT(6) UNSIGNED,
    token VARCHAR(32) NOT NULL,
    isAdmin BOOL
);

INSERT INTO
    account (
        name,
        login,
        email,
        password,
        isEnabled,
        isAdmin
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