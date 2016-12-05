use CampChamp_Employee;

delete from EmployeeJobHistory where uid > 0 or pos_id > 0;
delete from EmployeeJob where uid > 0 or pos_id > 0;
delete from Position where pos_id > 0;
delete from Employee where uid > 0;
delete from PromotionType where prom_id > 0;
delete from Department where did > 0;

insert into Department values(1, 'Human Resources');
insert into Department values(2, 'Web Development');
insert into Department values(3, 'Inventory Managment');
insert into Department values(4, 'Customer Service');
insert into Department values(5, 'Product Stocking');
insert into Department values(6, 'IT');
insert into Department values(7, 'Managment');
insert into Department values(8, 'Marketing');

insert into PromotionType values(11, 'Salary Raise');
insert into PromotionType values(22, 'Salary Decrease');
insert into PromotionType values(33, 'Position Upgrade');
insert into PromotionType values(44, 'Position Downgrade');
insert into PromotionType values(55, 'Quit');
insert into PromotionType values(66, 'Fired');

insert into Position values(1, 'CEO', 75000, 90000, 7);
insert into Position values(2, 'Inventory Manager', 45000, 60000, 3);
insert into Position values(3, 'IT Manager', 45000, 60000, 6);
insert into Position values(4, 'Product Manager', 45000, 60000, 5);
insert into Position values(5, 'Marketing Manager', 45000, 60000, 8);
insert into Position values(6, 'Web Manager', 45000, 60000, 2);
insert into Position values(7, 'HR Manager', 45000, 60000, 1);
insert into Position values(8, 'Inventory Staff', 30000, 40000, 3);
insert into Position values(9, 'Web developer', 30000, 45000, 2);

insert into Employee values(1, '2000-12-23');
insert into EmployeeJob values(1, 1, '2009-09-12', 80000);
insert into EmployeeJob values(1, 3, '2000-12-23', 50000);
insert into EmployeeJobHistory values(1, 3, '2000-12-23', '2009-09-12', 33);

insert into Employee values(2, '2010-12-13');
insert into EmployeeJob values(2, 2, '2010-12-13', 50000);

insert into Employee values(3, '2015-06-23');
insert into EmployeeJob values(3, 9, '2015-06-23', 30000);

insert into Employee values(5, '2010-12-13');
insert into EmployeeJob values(5, 8, '2010-12-13', 34000);

insert into Employee values(6, '2015-06-23');
insert into EmployeeJob values(6, 7, '2015-06-23', 35000);

insert into Employee values(7, '2010-12-13');
insert into EmployeeJob values(7, 8, '2010-12-13', 68000);

insert into Employee values(8, '2015-06-23');
insert into EmployeeJob values(8, 6, '2015-06-23', 90000);

select * from Employee;
select * from EmployeeJob;
select * from EmployeeJobHistory;
select * from Position;
select * from PromotionType;
select * from Department;