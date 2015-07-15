
CREATE TABLE `UserRace` ( `userRaceId` INT NOT NULL AUTO_INCREMENT , `userFk` INT NOT NULL , `raceFk` INT NOT NULL , PRIMARY KEY (`userRaceId`) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO UserRace (userFk , raceFk) (select userId, raceFk from User where role = 'race master');
