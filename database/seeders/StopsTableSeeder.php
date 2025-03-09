<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StopsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('stops')->insert([
             
['id'=>1,'name'=>'RejtanaSkrzyżowanie','address'=>'ul.Rejtana1','stoppic'=>'ozOMpHCp8Bb9LBvRref4SzbM1Z65kOMv6jwzq0dq.jpg'], 
['id'=>2,'name'=>'LisaKuliRondo','address'=>'ul.LisaKuli15','stoppic'=>'EcTpl9VYbHQ4udLdRPGyLQWzcbkomo4wbVb3kXQE.jpg'], 
['id'=>3,'name'=>'DworzecGłównyPKP','address'=>'ul.Grottgera2','stoppic'=>'lSkorrY9H7kXdPGJsTY4oVc3iLKuJEFKV3Q5ezWU.jpg'], 
['id'=>4,'name'=>'Kilara02','address'=>'ul.Kilara02','stoppic'=>'zEGACELJAv7RJKLE8N77D33PV6GY980Wvv52vNoZ.jpg'], 
['id'=>5,'name'=>'Pl.WolnościFontanna','address'=>'Pl.Wolności7','stoppic'=>'8sN0eAJ8hy0nk0Qrjzu1v08SVRO0pE4yBO1pe9uB.jpg'], 
['id'=>6,'name'=>'StaroniwaCmentarz','address'=>'ul.Krakowska20','stoppic'=>'wWJRAmXdycixsL2MAjegVQqC3j8n94DwcqdY7iGW.jpg'], 
['id'=>7,'name'=>'ŁukasiewiczaPętla','address'=>'ul.IgnacegoŁukasiewicza88','stoppic'=>'rOB93FbAk8unaDZIpSWrkiEwGU1NER3dvn0haaQL.jpg'], 
['id'=>8,'name'=>'GaleriaRzeszówGłówneWejście','address'=>'al.Piłsudskiego44','stoppic'=>'fohwGgyb90gc1viHUcHSMR6BMKkxt3JPHNQD9Gua.jpg'], 
['id'=>9,'name'=>'MilleniumHallParking','address'=>'ul.Kopisto1','stoppic'=>'A3qBvXBqvbxboZoZlhAtixrkCy9egib7iyF8dYgM.jpg'], 
['id'=>10,'name'=>'NoweMiastoOsiedle','address'=>'ul.Podwisłocze25','stoppic'=>'PgBKsIXaLabDW9Mr823pxjUNfiEnmpRITEfDNUTu.jpg'], 
['id'=>11,'name'=>'KwiatkowskiegoSkrzyżowanie','address'=>'ul.Kwiatkowskiego8','stoppic'=>'mltygGWtJhT2CBC7kErmHVdmVeS6jyhuSDz7BIym.jpg'], 
['id'=>12,'name'=>'SzpitalWojewódzkiSOR','address'=>'ul.Szopena2','stoppic'=>'T8bBkQ16Ige5vUpcmyc4RlK6Ve97lLv78ZKA3tLH.jpg'], 
['id'=>13,'name'=>'UniwersytetRzeszowskiWydziałPrawa','address'=>'al.Rejtana16c','stoppic'=>'0AT9dPbGwegAweVdrZ9UITdib5R9K2Y9a14tIIUz.jpg'], 
['id'=>14,'name'=>'CentrumWystawienniczo-KongresoweG2AArena','address'=>'ul.CentumWystawiennicze2','stoppic'=>'R3m5KqVhXYSVWG7DglKl73S49MBCzPBJH9utcIWQ.jpg'], 
['id'=>15,'name'=>'PortLotniczyRzeszów-JasionkaTerminal','address'=>'ul.Jasionka952','stoppic'=>'aduZYh1D0pKPzPAcsNHErCoTzLPBQLoCTcPtrq8M.jpg'], 
['id'=>16,'name'=>'TyczynRynek','address'=>'ul.Mickiewicza1','stoppic'=>'ozOMpHCp8Bb9LBvRref4SzbM1Z65kOMv6jwzq0dq.jpg'], 
['id'=>17,'name'=>'BłażowaZamek','address'=>'ul.Rynek1','stoppic'=>'6Pw3f4gh2UZc4SGFYCrBFolPem71ZRVk1px1bBFJ.jpg'], 
['id'=>18,'name'=>'ŁańcutZamek','address'=>'Pl.Sobieskiego1','stoppic'=>'TDGPs9PTi7dEtU0r7YLRhX2inHZ8asqcqZdWA7bu.jpg'], 
['id'=>19,'name'=>'PrzeworskDworzecPKP','address'=>'ul.Jagiellońska1','stoppic'=>'hLy4shNQI7QrceFkQqsR18kl7edz2FlqEiC7APQd.jpg'], 
['id'=>20,'name'=>'LeżajskBazylika','address'=>'ul.Mickiewicza2','stoppic'=>'ZcetUgJrg5XYTYcBeFbUDHwBFQom3XUHxZJPkalj.jpg'], 
['id'=>21,'name'=>'GłogówMałopolskiUrządMiasta','address'=>'ul.Rynek10','stoppic'=>'Y2otQfxt18pZjcvun6AOUPtHHBfTdtg83OaBvbkp.jpg'], 
['id'=>22,'name'=>'KolbuszowaRynek','address'=>'ul.ObrońcówPokoju1','stoppic'=>'xand9uS35m8AEDK4AQDsGfCHF03Xq4yeh4RmMBdE.jpg'], 
['id'=>23,'name'=>'RopczyceRynek','address'=>'ul.Rynek5','stoppic'=>'ElABD7bE5MXBmMMuSiVXH2RFlE5ozRnWPOXcoGsZ.jpg'], 
['id'=>24,'name'=>'SędziszówMałopolskiRynek','address'=>'ul.Rynek12','stoppic'=>'sgdrlojlvSvVeSjbPNMinQpkTFdzhd6TpGzcmdER.jpg'], 
['id'=>25,'name'=>'StrzyżówRynek','address'=>'ul.Rynek8','stoppic'=>'li2L54tUfUZ6vwLdfa0phQlB1d4aMi11ABwk1nDd.jpg'],
        ]);
    }
}
