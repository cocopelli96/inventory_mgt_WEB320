use CampChamp_Vendor;

delete from VendorContact where rep_cid > 0 or rep_id > 0;
delete from RepContact where rep_cid > 0;
delete from VendorRep where rep_id > 0 or vid > 0;
delete from Rep where rep_id > 0;
delete from Vendor where vid > 0;

insert into Vendor values(1, 'Aceme Rope Store');
insert into Vendor values(2, 'Grendor Survival');
insert into Vendor values(3, 'Junni Haddum');

insert into Rep values(1, 'June', 'Reckor');
insert into Rep values(2, 'Marry', 'Kelpi');
insert into Rep values(3, 'Greg', 'Shirwin');
insert into Rep values(4, 'Bruce', 'Waine');

insert into RepContact values(11, 'Work Phone');
insert into RepContact values(22, 'Work E-mail');

insert into VendorRep values(1, 1);
insert into VendorRep values(1, 2);
insert into VendorRep values(2, 3);
insert into VendorRep values(3, 4);

insert into VendorContact values(1, 11, '786-456-7346');
insert into VendorContact values(1, 22, 'june.reckor@acme.com');
insert into VendorContact values(2, 11, '545-444-5677');
insert into VendorContact values(2, 22, 'marry.kelpi@acme.com');
insert into VendorContact values(3, 11, '112-120-0092');
insert into VendorContact values(3, 22, 'greg.shirwin@grendor.com');
insert into VendorContact values(4, 11, '345-233-1252');
insert into VendorContact values(4, 22,  'bruce.waine@junni.com');

select * from Vendor;
select * from Rep;
select * from VendorRep;
select * from RepContact;
select * from VendorContact;