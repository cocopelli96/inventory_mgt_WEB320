use CampChamp_User;

delete from Email where uid > 0 or cont_id > 0;
delete from Phone where uid > 0 or cont_id > 0;
delete from UserContact where uid > 0 or cont_id > 0;
delete from UserAddress where uid > 0 or aid > 0 or add_type_id > 0;
delete from Address where aid > 0;
delete from UserAccount where uid > 0;
delete from User where uid > 0;
delete from Contact where cont_id > 0;
delete from AddressType where add_type_id > 0;
delete from Permissions where perm_id > 0;

insert into Permissions values(111, 'Customer Account');
insert into Permissions values(222, 'Employee Account');
insert into Permissions values(333, 'Inventory Manager');
insert into Permissions values(444, 'Employee Manager');

insert into AddressType values(11, 'Home Address');
insert into AddressType values(22, 'Billing Address');
insert into AddressType values(33, 'Shipping Address');

insert into Contact values(1, 'Home Phone');
insert into Contact values(2, 'Work Phone');
insert into Contact values(3, 'Cell Phone');
insert into Contact values(4, 'Work E-mail');
insert into Contact values(5, 'Other E-mail');

insert into User values(1, 'Sam', 'Smythe');
insert into UserAccount values(1, 'sam.smythe', 'Help123!', 444);
insert into Address values(1, '45 Elf Street', 'Holand', '90877', 'VT');
insert into UserAddress values(1, 11, 1);
insert into UserContact values(1, 2);
insert into UserContact values(1, 4);
insert into Phone values(1, 2, '567', '453', '1100');
insert into Email values(1, 4, 'sam.smythe@campchamp.com');

insert into User values(2, 'Dan', 'Mathews');
insert into UserAccount values(2, 'dan.mathews', 'Help123!', 333);
insert into Address values(2, '23 Harvard Road', 'Holand', '90877', 'VT');
insert into UserAddress values(2, 11, 2);
insert into UserContact values(2, 2);
insert into UserContact values(2, 4);
insert into Phone values(2, 2, '568', '453', '1100');
insert into Email values(2, 4, 'dan.mathews@campchamp.com');

insert into User values(3, 'Bob', 'Rand');
insert into UserAccount values(3, 'bob.rand', 'Help123!', 222);
insert into Address values(3, '1 Fried Drive', 'Holand', '90877', 'VT');
insert into UserAddress values(3, 11, 3);
insert into UserContact values(3, 2);
insert into UserContact values(3, 4);
insert into Phone values(3, 2, '567', '342', '1100');
insert into Email values(3, 4, 'bob.rand@campchamp.com');

insert into User values(4, 'Yuri', 'Yuuko');
insert into UserAccount values(4, 'yuri.yuuko', 'Help123!', 111);
insert into Address values(4, '67 Doom Street', 'Holand', '90877', 'VT');
insert into UserAddress values(4, 11, 4);
insert into UserContact values(4, 2);
insert into UserContact values(4, 3);
insert into Phone values(4, 2, '567', '453', '2345');
insert into Email values(4, 3, 'yuri.yuuko@home.com');

insert into User values(5, 'Harry', 'Potter');
insert into UserAccount values(5, 'harry.potter', 'Help123!', 333);
insert into Address values(5, '76 Fairy Lane', 'Holand', '90877', 'VT');
insert into UserAddress values(5, 11, 5);
insert into UserContact values(5, 2);
insert into UserContact values(5, 4);
insert into Phone values(5, 2, '453', '123', '1111');
insert into Email values(5, 4, 'harry.potter@campchamp.com');

insert into User values(6, 'Marry', 'Lamb');
insert into UserAccount values(6, 'marry.lamb', 'Help123!', 222);
insert into Address values(6, '13 Fried Drive', 'Holand', '90877', 'VT');
insert into UserAddress values(6, 11, 6);
insert into UserContact values(6, 2);
insert into UserContact values(6, 4);
insert into Phone values(6, 2, '111', '222', '3333');
insert into Email values(6, 4, 'marry.lamb@campchamp.com');

insert into User values(7, 'Jane', 'Doe');
insert into UserAccount values(7, 'jane.doe', 'Help123!', 333);
insert into Address values(7, '111 Runner Road', 'Holand', '90877', 'VT');
insert into UserAddress values(7, 11, 7);
insert into UserContact values(7, 2);
insert into UserContact values(7, 4);
insert into Phone values(7, 2, '122', '987', '8823');
insert into Email values(7, 4, 'jane.doe@campchamp.com');

insert into User values(8, 'Kenneth', 'Brand');
insert into UserAccount values(8, 'kenneth.brand', 'Help123!', 222);
insert into Address values(8, '666 Marked Drive', 'Holand', '90877', 'VT');
insert into UserAddress values(8, 11, 8);
insert into UserContact values(8, 2);
insert into UserContact values(8, 4);
insert into Phone values(8, 2, '133', '666', '2345');
insert into Email values(8, 4, 'kenneth.brand@campchamp.com');

insert into User values(9, 'Danni', 'Andrews');
insert into UserAccount values(9, 'danni.andrews', 'Help123!', 111);
insert into Address values(9, '2 Ghost Street', 'Holand', '90877', 'VT');
insert into UserAddress values(9, 11, 9);
insert into UserContact values(9, 2);
insert into UserContact values(9, 3);
insert into Phone values(9, 2, '263', '415', '7238');
insert into Email values(9, 3, 'danni.andrews@home.com');

insert into User values(10, 'Trevor', 'Hammer');
insert into UserAccount values(10, 'trevor.hammer', 'Help123!', 111);
insert into Address values(10, '3 Down Lane', 'Holand', '90877', 'VT');
insert into UserAddress values(10, 11, 10);
insert into UserContact values(10, 2);
insert into UserContact values(10, 3);
insert into Phone values(10, 2, '245', '267', '3784');
insert into Email values(10, 3, 'trevor.hammer@home.com');

select * from User;
select * from Permissions;
select * from UserAccount;
select * from Contact;
select * from UserContact;
select * from AddressType;
select * from Address;
select * from UserAddress;
select * from Phone;
select * from Email;