<?php namespace App\Controllers;

use App\Models\DataModel;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;


class Pages extends BaseController
{

	
    protected $dataModel;
	public function __construct(){
        
		$this->dataModel = new DataModel();
		
    }
	
	public function index()
	{

	
		// $this->saveData();

		$result = $this->dataModel->getData();
		 
		 $data = [
			 'title' => 'Dashboard | Blast Email',
			 'result' => $result
			];
			// dd($resp);
		return view('pages/home',$data);
	}

    public function home()
	{
        
		return redirect()->to('/login');
	}
	
	public function barcode(){
		return view('barcode');
	}

	public function blast(){
	
		
		
		$db      = \Config\Database::connect();
		$builder = $db->table('data_miner');
		
		$query = $builder->get();

		foreach ($query->getResult() as $row)
		{

			

			if($row->terkirim == "0"){
		// Creat
					
																
				$qrCode = new QrCode($row->barcode);
				$qrCode->writeFile(__DIR__.'../../../public/qrcode/'.$row->barcode.'.png');

				$postdata = http_build_query(
						array(
							'emailRecipient' => $row->email,
							'emailBodyEmail' => '
								<body style="margin: 0; padding: 0;">
								<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
									<tr>
										<td style="padding: 10px 0 30px 0;">
											<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
												<tr>
													<td align="center" bgcolor="#00000" style="padding: 0px 0 0px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
														<img src="https://app.splashminer.com:8090/Content/assets/img/logo.png" alt="Creating Email Magic" width="200"style="display: block;" />
													</td>
												</tr>
												<tr>
													<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
														<table border="0" cellpadding="0" cellspacing="0" width="100%">
															<tr>
																<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
																	<b>Halo para Miners,</b>
																</td>
															</tr>
															<tr>
																<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																

																Dengan kerendahan hati Kami mengundang Anda untuk menghadiri acara : <br>
																Grand Launching  SPLASHCOIN Blockchain  yang akan diadakan pada :
																<br>
																<br>
																Hari : Minggu 
																<br>
																Tanggal : 16 Agustus 2020
																<br>
																Waktu : 16:00 WIB
																<br>
																Tempat : Arosa Hotel Jakarta.
																<br>
																No 3, RT.9/RW.3, Bintaro, Kec. Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12330
																<br>
															<a href="https://maps.app.goo.gl/5QGvYqjx63daR7zo6">https://maps.app.goo.gl/5QGvYqjx63daR7zo6</a><br><br>

																Kedatangan Anda sangat dinanti, SPLASHCOIN membantu banyak orang untuk menjadi lebih sejahtera dan bahagia. 
																<br>
																<br>
																Silahkan melakukan konfirmasi kedatangan dengan mengisi form di bawah ini :
																<br>
																<br>
																<a href="https://forms.gle/zDpWku65szBt3WFKA">https://forms.gle/zDpWku65szBt3WFKA</a> 
																<br>
																<br>
																Kami tunggu kehadiran Anda, akan ada undian berhadiah sepeda motor dan hadiah menarik lainnya yang menanti.
																<br>
																<br>
																Salam Miners!!
																<br>
																<br>
																<img src="http://localhost:8080/qrcode/'.$row->barcode.'.png" alt="http://localhost:8080/qrcode/'.$row->barcode.'.png" width="200"style="display: block;" />
																<br>
																<br>
																SPLASHCOIN Team
																</td>
									</tr>
														
								</table>
								
							</body>
														
							' ,
							'emailSubject' => 'Invitation',
							'emailType' => 'NON VERIFIKASI'
						)
					);
					$opts = array('http' =>
					array(
						'method'  => 'POST',
						'header'  => 'Content-Type: application/x-www-form-urlencoded',
						'content' => $postdata
					)
				);
				
					$context  = stream_context_create($opts);
					
					$result = file_get_contents('https://devapi.splashminer.com:8182/api/email', false, $context);

				$query ="UPDATE data_miner SET terkirim=1 WHERE email='". $row->email ."'";

				$db->query($query);
				session()->setFlashdata('success','Berhasil blast email.');
			}else{
				session()->setFlashdata('error','Email sudah di blast semua.');
			}


			return redirect()->to('/home');
		}

     


	}

	public function saveData(){
		$resp = file_get_contents("https://devapi.splashminer.com:8187/api/values/1");
		$setDecode = json_decode($resp, true);

		foreach ($setDecode as $key => $value) {
			$db      = \Config\Database::connect();
			$db->table('data_miner');

		
			$query="INSERT INTO `data_miner` 
			(user_id,nama,email,barcode,no_undian,terkirim,status) 
			SELECT '". $value["userid"] ."','". $value["nama"] ."','". $value["email"] ."','". $value["barcode"] ."',0,0,0 FROM (SELECT 1) t WHERE NOT EXISTS (SELECT email FROM `data_miner` WHERE email='". $value["email"] ."')";
			 
			
			$db->query($query);
		}
	}

	public function generateQr(){
		$qrCode = new QrCode('Life is too short to be generating QR codes');
		$qrCode->writeFile(__DIR__.'../../../public/qrcode/as.png');


		// return view('barcode');
	}
}
