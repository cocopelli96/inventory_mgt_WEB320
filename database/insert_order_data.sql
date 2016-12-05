use CampChamp_Order;

delete from OrderStatusHistory where order_id > 0 or stat_id > 0;
delete from OrderStatus where order_id > 0 or stat_id > 0;
delete from OrderPayment where order_id > 0 or uid > 0;
delete from OrderItem where order_id > 0;
delete from StatusCode where stat_id > 0;
delete from CustomerOrder where order_id > 0;

insert into StatusCode values(11, 'Being Fullfilled');
insert into StatusCode values(22, 'Packaged');
insert into StatusCode values(33, 'Preparing to ship');
insert into StatusCode values(44, 'Shipped');
insert into StatusCode values(55, 'Arrived');
insert into StatusCode values(66, 'Being returned');
insert into StatusCode values(77, 'Recieved at store');
insert into StatusCode values(88, 'Ready for pickup');

insert into CustomerOrder values(1, '2016-10-10', 0.06, 10);
insert into OrderItem values(1, 2, 1);
insert into OrderItem values(1, 1, 12);
insert into OrderPayment values(1, 4, 111, '1212121212121212');
insert into OrderStatus values(1, 11, '2016-10-11', 2);
insert into OrderStatus values(1, 22, '2016-10-12', 2);
insert into OrderStatusHistory values(1, 11, '2016-10-11', '2016-10-12');

insert into CustomerOrder values(2, '2016-12-10', 0.06, 10);
insert into OrderItem values(2, 2, 1);
insert into OrderItem values(2, 1, 12);
insert into OrderPayment values(2, 4, 111, '1212121212121212');
insert into OrderStatus values(2, 11, '2016-12-11', 2);

insert into CustomerOrder values(3, '2016-09-10', 0.06, 10);
insert into OrderItem values(3, 2, 1);
insert into OrderItem values(3, 1, 12);
insert into OrderPayment values(3, 4, 111, '1212121212121212');
insert into OrderStatus values(3, 11, '2016-09-11', 2);

insert into CustomerOrder values(4, '2016-10-10', 0.06, 10);
insert into OrderItem values(4, 2, 1);
insert into OrderItem values(4, 1, 12);
insert into OrderPayment values(4, 9, 111, '1212341212121212');
insert into OrderStatus values(4, 11, '2016-10-11', 2);
insert into OrderStatus values(4, 22, '2016-10-12', 2);
insert into OrderStatus values(4, 33, '2016-10-13', 2);
insert into OrderStatus values(4, 44, '2016-10-14', 2);
insert into OrderStatusHistory values(4, 11, '2016-10-11', '2016-10-12');
insert into OrderStatusHistory values(4, 22, '2016-10-12', '2016-10-13');
insert into OrderStatusHistory values(4, 33, '2016-10-13', '2016-10-14');

insert into CustomerOrder values(5, '2016-10-10', 0.06, 10);
insert into OrderItem values(5, 2, 1);
insert into OrderItem values(5, 1, 12);
insert into OrderPayment values(5, 9, 111, '1212341212121212');
insert into OrderStatus values(5, 11, '2016-10-11', 2);
insert into OrderStatus values(5, 22, '2016-10-12', 2);
insert into OrderStatusHistory values(5, 11, '2016-10-11', '2016-10-12');

insert into CustomerOrder values(6, '2016-10-10', 0.06, 10);
insert into OrderItem values(6, 2, 1);
insert into OrderItem values(6, 1, 12);
insert into OrderPayment values(6, 10, 333, '3111111111111111');
insert into OrderStatus values(6, 11, '2016-10-11', 2);
insert into OrderStatus values(6, 22, '2016-10-12', 2);
insert into OrderStatus values(6, 33, '2016-10-13', 2);
insert into OrderStatus values(6, 44, '2016-10-14', 2);
insert into OrderStatus values(6, 55, '2016-10-15', 2);
insert into OrderStatusHistory values(6, 11, '2016-10-11', '2016-10-12');
insert into OrderStatusHistory values(6, 22, '2016-10-12', '2016-10-13');
insert into OrderStatusHistory values(6, 33, '2016-10-13', '2016-10-14');
insert into OrderStatusHistory values(6, 44, '2016-10-14', '2016-10-15');

select * from CustomerOrder;
select * from StatusCode;
select * from OrderItem;
select * from OrderPayment;
select * from OrderStatus;
select * from OrderStatusHistory;