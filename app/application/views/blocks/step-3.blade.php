<div class="left">
	<label class="wide">Your Name: <input type="text" name="senderName" required></label>

	<label>Mother's Name: <input type="text" name="recepientName" required></label>
	<label>Mother's Email: <input type="email" name="recepientEmail" required></label>
	<input type="hidden" name="usereCard[img]">
	<input type="hidden" name="usereCard[slug]">
	<input type="hidden" name="usereCard[thumb]">
	<input type="hidden" name="usereCard[url]">
</div>

<div class="cardPreview">
	{{ HTML::image( URL::to_asset( Session::has('usereCard') ? Session::get('usereCard')['img'] : '' ), '', array('class' => 'usereCard') ) }}
</div>

<button type="submit" class="send btn">Send</button>