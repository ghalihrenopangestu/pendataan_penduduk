function chat(){
// chat_id = "1234567890";     <!--INI CONTOH GANTI YANG DIBAWAHNYA-->
chat_id = "1136312864";
// token = "423903821:AAE9-rq9NMS_HFVMTk09UVyDnEFRBfdCkkc";     <!--INI CONTOH GANTI YANG DIBAWAHNYA-->
token = "1306451202:AAFL84nqcQjbAsEpRqVCziQ0VGty4qIAxt4";
message = "<b>Pesan dari web Data Penduduk</b>%0Anama : "+ $("#nama").val() + "%0Aalamat : " + $("#alamat").val() + "%0Ano. hp : wa.me/" + $("#no_hp").val() + "%0Apesan : " + $("#pesan").val();
$.get("https://api.telegram.org/bot"+token+"/sendMessage?chat_id="+chat_id+"&text="+message+"&parse_mode=html");
$("#modal-signup").modal("hide");
$("#confirm").modal("show");
}
