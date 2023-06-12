
create table animals(id primary key int, animalid int, name varchar(50), science_name varchar(50), type varchar(20),
region varchar(50), climate varchar(20), conservation_status varchar(50), description varchar(500), min_weight int, max_weight int, date timestamp);

ALTER TABLE animals ADD INDEX(animalid);
ALTER TABLE animals ADD INDEX(name);
ALTER TABLE animals ADD INDEX(science_name);
ALTER TABLE animals ADD INDEX(type);
ALTER TABLE animals ADD INDEX(region);
ALTER TABLE animals ADD INDEX(climate);
ALTER TABLE animals ADD INDEX(conservation_status);
ALTER TABLE animals ADD INDEX(min_weight);
ALTER TABLE animals ADD INDEX(max_weight);
