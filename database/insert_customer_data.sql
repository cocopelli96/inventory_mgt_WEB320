use CampChamp_Customer;

delete from CreditDebit where uid > 0 or method_id > 0;
delete from Checking where uid > 0 or method_id > 0;
delete from Bank where routing_id > 0;
delete from CustomerPayment where uid > 0 or method_id > 0;
delete from PaymentMethod where method_id > 0;
delete from Customer where uid > 0;
delete from Title where title_id > 0;

insert into Title values(11, 'Mr');
insert into Title values(22, 'Ms');
insert into Title values(33, 'Mrs');
insert into Title values(44, 'Dr');

insert into PaymentMethod values(111, 'Credit Card');
insert into PaymentMethod values(222, 'Debit Card');
insert into PaymentMethod values(333, 'Checking Account');

insert into Customer values(4, 33);
insert into CustomerPayment values(4, 111);
insert into CustomerPayment values(4, 333);
insert into Bank values('11111111111', 'National Bank');
insert into CreditDebit values(4, 111, '1212121212121212', 'Visa', 'Yuri Yuuko', 9002, '90877', 2, 2020);
insert into Checking values(4, 333, '1111111111111111', '11111111111');

insert into Customer values(9, 22);
insert into CustomerPayment values(9, 111);
insert into CustomerPayment values(9, 333);
insert into CreditDebit values(9, 111, '1212341212121212', 'Visa', 'Danni Andrews', 9022, '90877', 3, 2020);
insert into Checking values(9, 333, '2111111111111111', '11111111111');

insert into Customer values(10, 11);
insert into CustomerPayment values(10, 333);
insert into Checking values(10, 333, '3111111111111111', '11111111111');

select * from Customer;
select * from Title;
select * from PaymentMethod;
select * from CustomerPayment;
select * from Checking;
select * from CreditDebit;
select * from Bank;