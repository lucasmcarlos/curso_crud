CREATE TABLE `aluno` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` varchar(55),
    `data_nascimento` DATE,
    `nome_mae` varchar(55),
    `email` varchar(55),
    PRIMARY KEY (`id`)
);

CREATE TABLE `usuario` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `login` varchar(15) NOT NULL,
    `senha` varchar(60) NOT NULL,
    `aluno_id` INT NOT NULL,
    PRIMARY KEY (`id`)
);

ALTER TABLE `usuario` ADD CONSTRAINT `usuario_fk0` FOREIGN KEY (`aluno_id`) REFERENCES `aluno`(`id`);
