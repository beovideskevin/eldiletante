START TRANSACTION;
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
    `id` int(11) NOT NULL,
    `gallery` varchar(256) NOT NULL,
    `thumbnail` varchar(256) NOT NULL,
    `image` varchar(256) NOT NULL,
    `title` varchar(256) NOT NULL,
    `description` varchar(256) NOT NULL,
    `datasize` varchar(256) NOT NULL,
    `url` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `gallery` ADD PRIMARY KEY (`id`);
ALTER TABLE `gallery` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;