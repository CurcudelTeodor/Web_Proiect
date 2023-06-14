
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


--insert in bd
INSERT INTO `animals` (`id`, `animalid`, `name`, `science_name`, `type`, `region`, `climate`, `conservation_status`, `description`, `min_weight`, `max_weight`, `date`) 
VALUES (NULL, '1', 'Lion', 'Panthera leo', 'Mammal', 'Africa', 'Savannah', 'Endangered', 'Lions are large and powerful carnivores known for their majestic appearance and distinctive manes. Lions (scientifically known as Panthera leo) are the only truly social cats, living in family groups called prides. Adult males are easily recognized by their impressive manes, which vary in color and length. They have a muscular and compact body, females being slightly smaller. Lions have a sandy or tawny coat, providing camouflage in their savanna and grassland habitats. They are highly specialized predators with sharp retractable claws, strong jaws, and formidable teeth. 
Lions are primarily active during the cooler hours of the day, often engaging in cooperative hunting strategies to take down large ungulate prey such as zebras, wildebeests, and buffalo. However, they are opportunistic and will scavenge or prey on smaller animals when necessary.', 150, 250, current_timestamp());


INSERT INTO `animals` (`id`, `animalid`, `name`, `science_name`, `type`, `region`, `climate`, `conservation_status`, `description`, `min_weight`, `max_weight`, `date`) 
VALUES (NULL, 2, 'Green Python', 'Morelia viridis', 'Reptile', 'Australia', 'Rainforest', 'Least Concern', "The Green Python (Morelia viridis), also known as the Green Tree Python, is a species of non-venomous snake found in the tropical rainforests of northern Australia and Papua New Guinea. It is known for its striking emerald-green coloration, which provides excellent camouflage in the lush green foliage of its habitat. The snake has a slender body with a slightly flattened head and eyes that have vertical pupils.\r\n\r\nThe Green Python exhibits sexual dimorphism, with females generally being larger and heavier than males. The minimum and maximum weight of Green Pythons can vary depending on factors such as age, sex, and overall health. On average, adult males typically weigh between 1 to 1.5 kilograms, while adult females can reach weights ranging from 1.5 to 2.5 kilograms.It's important to note that individual snakes can exhibit some variation in size and weight, and exceptional individuals may exceed these average ranges. These weight ranges provide a general idea of the size and weight characteristics of the Green Python species.", 1, 3, current_timestamp());
