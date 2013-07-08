<div class="rateBox_inter">
	<span class="toBorder"></span>
	<div class="mainContentRates">
		<div class="rateCode">
			<div class="clearBoth"> </div>
			<div class="flagImgContainer">{{ HTML::image( URL::to_asset('img/tr.png'), '', array( 'id' => 'flag', 'class' => 'flagImg' ) ) }}</div>
			<div id="countryName" class="cntryName">Turkey</div>
			<table id="rates" class="intRates">
				<tbody>
					<tr>
						<th>Landlines<br>
							<span>per min</span>
						</th>
						<th>Mobiles<br>
							<span>per min</span>
						</th>
						<th>Texts<br>
							<span>per message</span>
						</th>
					</tr>
					<tr>
						<td id="landlineRate" width="33%">2p</td>
						<td id="mobileRate" width="33%">10p</td>
						<td id="textRate" width="33%">10p</td>
					</tr>
				</tbody>
			</table>
			<p class="rates_bottom">Prices are for calls and<br> texts made from the UK</p>
			<a target="_blank" href="{{ Config::get('application.ordernow_url') }}"><span>Order Now</span></a>
		</div>
	</div>
	<span class="bottomorder"></span> 
</div>