function JamDigital(){
    var nama_bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
         "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    var nama_hari = ["Minggu,", "Senin,", "Selasa,", "Rabu,", "Kamis,", "Jum'at,", "Sabtu,"];

    var hari_ini = new Date();

    document.getElementById('date').innerHTML = (nama_hari[hari_ini.getDay()] + " " +
        hari_ini.getDate() + ' ' + nama_bulan[hari_ini.getMonth()] + ' ' + hari_ini.getFullYear(    
        ));

    var h = hari_ini.getHours();
    var m = hari_ini.getMinutes();
    var s = hari_ini.getSeconds();
    var day = h<11 ? 'AM' : 'PM';

    h = h<10? '0'+h: h;
    m = m<10? '0'+m: m;
    s = s<10? '0'+s: s;

    document.getElementById('jam').innerHTML = h;
    document.getElementById('menit').innerHTML = m;
    document.getElementById('detik').innerHTML = s;
}var inter = setInterval(JamDigital,400);