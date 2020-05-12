
CREATE DATABASE IF NOT EXISTS `dbphp7` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbphp7`;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuario_insert` (`pdeslogin` VARCHAR(100), `pdessenha` VARCHAR(100))  BEGIN
	INSERT INTO tab_usuarios (deslogin,dessenha) VALUES (pdeslogin,pdessenha);
    SELECT * FROM tab_usuarios WHERE id = LAST_INSERT_ID();
END$$

DELIMITER ;

CREATE TABLE `tab_usuarios` (
  `id` int(11) NOT NULL,
  `deslogin` varchar(100) DEFAULT NULL,
  `dessenha` varchar(100) DEFAULT NULL,
  `dtcadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tab_usuarios`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `tab_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


