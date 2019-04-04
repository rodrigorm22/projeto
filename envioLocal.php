<?php	
	if(isset($_POST['valida']) && empty($_POST['valida'])){
		
		
			//enviando o email
			//$enviarPara 	= 'naitech.informatica@gmail.com';
			//$enviarPara 	= 'atendimento@entregaimediatab2b.com.br';
			//$copiaPara 		= 'noreply@entregaimediatab2b.com.br';
			$enviarPara 	= 'rodrigo.maciel@drivea.com.br';
			$copiaPara 		= 'rodrigorochamaciel@gmail.com';
			$postEmail 		= trim(htmlspecialchars($_POST['email'], ENT_QUOTES));
			$postAssunto	= trim(htmlspecialchars($_POST['assunto'], ENT_QUOTES));
			$postTipo   	= trim(htmlspecialchars($_POST['tipo'], ENT_QUOTES));
			$postNome		= trim(htmlspecialchars('ENTREGA IMEDIATA B2B', ENT_QUOTES));
			$postAderir		= $_POST['motivo'];
			
			$Aderir = '';
			$i = 1;
			foreach ($postAderir as $key => $val) {
				if($val['p']){
					$Aderir .= $i. '° ' .$val['p'].'<br>';
					$i++;
				}
			}
			
			
			if($postTipo == "Entrada"){

			$htmlSite = "		
				<table width='500' style='border:1px solid #666666;' cellspacing='0' cellpadding='0'>
					<tr style='font-weight:bold; font-family: Tahoma, Verdana, Arial, sans-serif; font-size:14px; color:#FFF; background-color:#2f417f; text-align:center'>
						<td style='padding:5px;'>".$postAssunto." - ".date("d-m-Y")."</td>
					</tr>
					<tr>
						<td align='center' style='padding:10px;'>
							<table width='480' border='0' cellspacing='0' cellpadding='0'>
								<tr>
									<td align='right' bgcolor='#EEE'><span style='font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 14px; font-weight: bold; padding-right:10px;'>E-mail:</span></td>
									<td bgcolor='#EEE'><span style='font-size: 14px; font-family:Tahoma, Verdana, Arial, sans-serif; color:#000;'>".$postEmail."</span></td>
								</tr>		
							</table>
						</td>
					</tr>					
				</table>
			";
			
			}else{
				
			$htmlSite = "		
				<table width='500' style='border:1px solid #666666;' cellspacing='0' cellpadding='0'>
					<tr style='font-weight:bold; font-family: Tahoma, Verdana, Arial, sans-serif; font-size:14px; color:#FFF; background-color:#2f417f; text-align:center'>
						<td style='padding:5px;'>".$postTipo." - ".$postAssunto." - ".date("d-m-Y")."</td>
					</tr>
					<tr>
						<td align='center' style='padding:10px;'>
							<table width='480' border='0' cellspacing='0' cellpadding='0'>
								<tr>
									<td align='right' bgcolor='#EEE'><span style='font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 14px; font-weight: bold; padding-right:10px;'>E-mail:</span></td>
									<td bgcolor='#EEE'><span style='font-size: 14px; font-family:Tahoma, Verdana, Arial, sans-serif; color:#000;'>".$postEmail."</span></td>
								</tr>
								<br/>
								<tr>
									<td align='right' bgcolor='#EEE'><span style='font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 14px; font-weight: bold; padding-right:10px;'>Motivos:</span></td>
									<td bgcolor='#EEE'><span style='font-size: 14px; font-family:Tahoma, Verdana, Arial, sans-serif; color:#000;'>".$Aderir."</span></td>
								</tr>			
							</table>
						</td>
					</tr>					
				</table>
			";
				
			}
			
			$htmlCliente = "		
				<div style='width:670px;height:429px;'>
					<a href='https://www.entregaimediatab2b.com.br/'><img src='http://d8vlg9z1oftyc.cloudfront.net/drivea/template/img/arteCupomDesconto.png'></a>
					<a href='http://d8vlg9z1oftyc.cloudfront.net/drivea/template/img/arteCupomDesconto.png'><p>Caso não consiga visualizar, clique aqui.</p></a>
				</div>
			";
			
			require_once("phpmailer/PHPMailerAutoload.php");

			$mainMail = new PHPMailer;
			$clienteMail = new PHPMailer;
			
			// MATRIZ 
			$mainMail->IsSMTP();
			$mainMail->CharSet    = 'UTF-8';
			$mainMail->SMTPDebug  = 0;
			$mainMail->SMTPAuth   = true;
			$mainMail->SMTPSecure = "ssl";
			$mainMail->Port       = 465;
			$mainMail->Host       = "smtp.gmail.com";
			$mainMail->Username   = "infra@drivea.com.br";
			$mainMail->Password   = "bobesponj@99.";
			$mainMail->SMTPDebug  = false;
			
			// CLIENTE 
		    $clienteMail->IsSMTP();
			$clienteMail->CharSet    = 'UTF-8';
			$clienteMail->SMTPDebug  = 0;
			$clienteMail->SMTPAuth   = true;
			$clienteMail->SMTPSecure = "ssl";
			$clienteMail->Port       = 465;
			$clienteMail->Host       = "smtp.gmail.com";
			$clienteMail->Username   = "infra@drivea.com.br";
			$clienteMail->Password   = "bobesponj@99.";
			$clienteMail->SMTPDebug  = false;
			
			 // * Define o remetente:
			 // MATRIZ 
			 $mainMail->SetFrom($copiaPara, $postNome);			 
			 $mainMail->AddReplyTo($copiaPara, $postNome); //Seu e-mail
			 $mainMail->Subject = $postAssunto;//Assunto do e-mail			 
			 // CLIENTE
			 $clienteMail->SetFrom($copiaPara, $postNome);			 
			 $clienteMail->AddReplyTo($copiaPara, $postNome); //Seu e-mail
			 $clienteMail->Subject = $postAssunto;//Assunto do e-mail
		 
		 
			 // * Define os destinatário(s)
			 // MATRIZ 
			 $mainMail->AddAddress($enviarPara);
			 $mainMail->AddAddress($copiaPara);		 
			 // CLIENTE
			 $clienteMail->AddAddress($postEmail);
		 
		 		 
			 // * Define o corpo do email
			 // MATRIZ
			 $mainMail->MsgHTML($htmlSite);
			 // CLIENTE
			 $clienteMail->MsgHTML($htmlCliente);
			 
			 
			 // Email enviado para a matriz
			 $mainMail->Send();
			 // Email enviado para o cliente
			 $clienteMail->Send();
			 			 
			 header("Location:http://entregaimediatab2b.com.br/");
			 
			 echo "
				<script>
					dataLayer.push({'FormularioEnviado':'enviado'});
				</script>
			 "; 		
	}
?>
