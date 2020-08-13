// function getData(){

// var xhr = new XMLHttpRequest();

// xhr.open("GET","https://devapi.splashminer.com:8187/api/values/1",true)



// xhr.onload = function(){
//     if(this.status == 200){
//         console.log(this.responseText)
        // document.getElementById('tr').innerText=this.responseText
//     }
// }

// xhr.send();

// }

// $.ajax({
//     url:"https://devapi.splashminer.com:8187/api/values/1",
//     dataType:'json',
//     success: function(data){
//         //  console.log(data[1].nama)
       
//          $.each(data,function(i,result){
//             // console.log(result)
//             $('#tbody').append('<tr id="baristabel"><td>1</td><td>'+result.nama+'</td><td>'+result.email+'</td><td>'+result.barcode+'</td><td>Belum</td> <td>1276157</td><td>Tidak Hadir</td><td><a href="#" class="btn btn-cirlce btn-success">Sync</a></td> </tr>')
//          })

//         // $(data).find("ValuesController.dataresult").each(function(){

//         //     var nama = $(this).find('nama').text();
//         //     console.log(nama);
//         // })

//     },
//     error:function(){
//         $('.result').text("failed to get data")
//     }
// })
// function fetchData(){
//     fetch('https://devapi.splashminer.com:8187/api/values/1', {
//         method: "get",
//         headers: {
//         "Content-Type": "application/json",
//         "X-Requested-With": "XMLHttpRequest"
//         }
//     }).then((result)=>{
//         result.json();
//     }).then((hasil)=>{
//         console.log(hasil)
//     });

// }
// fetchData();