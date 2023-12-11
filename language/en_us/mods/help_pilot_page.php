<?php
/**
*
* en/mods/help_pilot_page
*
* Built with the FAQ Manager Mod by EXreaction
* http://www.lithiumstudios.org/forum/viewtopic.php?f=31&t=464
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

$help = array(
	array(
		0 => '--',
		1 => 'Forum software features',
	),
	array(
		0 => 'Where are the instructions?',
		1 => 'A quick-start is <a href="https://www.pilotsnpaws.org/how-to-use-pnp/pilots/" style="text-decoration: underline" target=_blank">here</a>.',
	),
	array(
		0 => 'How can I receive automatic email notification of new transport requests in my area?',
		1 => 'To turn on email notifications, go to the User Control Panel, select Profile, and scroll to the bottom to the field labelled "Distance willing to fly one way:". This number is presently set to zero. Setting this to 100 will cause the system to notify you, through email, of any transport request that passes less than 100 miles from your airport.  <a href="/forum/ucp.php?i=164" style="text-decoration: underline" target="_blank">This link</a> should bring you to the profile page where you can change your options.',
	),
	array(
		0 => 'How can I be notified when I have a new private message?',
		1 => 'Go to your User Control Panel, click Board Preferences, put a dot on YES for "Allow users to send you private messages" and "Notify me on new private messages", and SUBMIT.',
	),
	array(
		0 => 'There are several private messages in my Inbox but I only received one notification.  Why?',
		1 => 'The board does not notify you of each new private message (PM) you get.  It notifies you of the first new private message you get, instructing you to log in to read it.  After that it does not send any more notifications of new PMs until you log in.',
	),
	array(
		0 => 'If I checkmark "Users can contact me by e-mail", will they know my email address?',
		1 => 'No.  Users who email you through board email (the email icon on your Profile) do not see your address.  If you choose to reply to their email, your address will show on your reply.',
	),
	array(
		0 => 'Why doesn\'t my name come up in the pilot listings on the map?',
		1 => 'In your Profile, be sure the pilot_yn field is set to "Yes".  In the AIRPORT_ID field, airports with three-letter IDs must be prefixed with a K.  If the ID contains numbers, no prefix is used (BOS becomes KBOS, 60M remains 60M).  If there are other pilots listed at your location, zoom the map in close to be sure your name is not buried in a cluster of pins.',
	),
	array(
		0 => 'My plane is down for maintenance.  How can I stop receiving transport requests?',
		1 => 'You can go to your User Control Panel (upper left on the forum board) and click on the Preferences tab. Change your preferences to no emails or PMs (private messages) for the duration of the time your plane is in maintenance. When you are ready to fly again, change those settings back to yes. Remember to click submit at the bottom of the page each time you make a change.',
	),
	array(
		0 => 'Where can I find a map of current transport requests?',
		1 => 'A graphical map of all active transport requests, with lines from departure point to destination, can be found <a href="/maps/maps_trips.php" style="text-decoration: underline" target="_blank">here</a>.  Southbound trips show up in green, north show up purple.',
	),
	array(
		0 => 'Where can I find a listing of all pilots by state and city?',
		1 => 'View it <a href="/forum/phpbb_pilots_city_state.php"  style="text-decoration: underline" target="_blank">here</a>.',
	),
	array(
		0 => 'How can I find a member if I only know the username?',
		1 => 'Use the \'Find a Member\' function on the Memberlist.  It is quicker than searching alphabetically.  <a href="/forum/find_member.php" style="text-decoration: underline" target ="_blank">Click here</a> to see how it works.',
	),
	array(
		0 => 'How do I keep personal information private?',
		1 => 'There are levels of privacy. 1) PUBLIC Anything posted on the forum is viewable by members and nonmembers alike, including information in your signature line. Posting contact info publicly is the surest way for other members to reach you, as it does not rely on forum notifications that may go to Spam or be undelivered 2) MEMBERS ONLY Anything included in your user Profile is semi-private, viewable only by registered members who are logged in. 3) MAXIMUM Do not put personal info in posts, signature, or Profile. Tell members to contact you by private message or board mail. The board mail feature does not show the sender your email address, however your email address will show if you reply. You may choose not to give your name, phone number, email, or tail number until you have committed to a flight after being contacted by PM or board mail. The disadvantages of this are, members are unable to reach you if your email address is not up-to-date in your account, and nondelivery of forum emails to some email accounts (sent to Spam or blocked by some ISPs).',
	),
	array(
		0 => '--',
		1 => 'Working with rescues',
	),
	array(
		0 => 'How do I know the person contacting me is a bona fide rescue?',
		1 => 'If there is any doubt, it is not unreasonable to start asking questions, such as the name of the rescue for the sending party or receiving party.  You are donating a lot of money and time to do a transport, you are entitled to ask for verification that the animal is a legitimate candidate for a transport.  One clue is if the email address of the sending or receiving party reads like it is from a rescue, or the sending or receiving party has a website. If a transport request is for multiple animals the probability you are transporting pets is slight.  However, there are times you are transporting pets for good reason, such as transporting service animals, or an animal from a rescue to adopters who will be the animal\'s forever home. There are hardship cases such as the transport of pets for people in our military, or a disabled pet being accepted into a sanctuary. The choice is yours as a pilot to accept or reject transport requests.',
	),
	array(
		0 => 'I registered but nobody has contacted me.  What do I need to do?',
		1 => 'Thank you for joining!  In your User Control Panel under Profile, there is a setting to edit your account so you will receive automatic email notifications of transport requests in your area.  You can also scan the <a href="/forum/viewforum.php?f=5" style="text-decoration: underline" target="_blank">Ride Board</a> checking for transport requests you might be able to help with.  You can also find transport requests on <a href="/maps/maps_trips.php" style="text-decoration: underline" target="_blank">this map</a>.',
	),
	array(
		0 => 'What documents should I require the rescue to provide?',
		1 => 'The paperwork we suggest for our pilots to request is a health certificate and an up-to-date proof of vaccine, rabies in particular.  A rabies 
vaccination (if the dog is old enough) and health certificate are necessary to cross state lines in most states.  It is up to each pilot if they would like any further 
information.  Click to check the <a href="http://www.aphis.usda.gov/import_export/animals/animal_import/animal_imports_states.shtml" style="text-decoration: underline" 
target="_blank">requirements</a> for each state the flight will pass through.',
	),
	array(
		0 => '--',
		1 => 'Expenses',
	),
	array(
		0 => 'Where can I get crates?',
		1 => 'Our MUCH APPRECIATED sponsor, <a href="http://www.petmate.com" style="text-decoration: underline" target="_blank">Petmate</a>, is supplying crates.  If you are in need of crates, collars, leashes, harnesses, etc. for your rescue flights, please email crates@pilotsnpaws.org  and we will ship them to you.',
	),
	array(
		0 => 'Can I get a discount on fuel for a Pilots N Paws flight?',
		1 => 'When you go into the FBO to order fuel, mention you are flying for Pilots N Paws and transporting rescue animals and they may offer you a discount.  You can also find a list of FBO\'s offering fuel discounts for PNP flights on the forum under <a href="/forum/viewforum.php?f=14" style="text-decoration: underline" target = "_blank">"FBO\'s who are Pet Friendly, Fuel Discounts"</a>.',
	),
	array(
		0 => 'How do I document a flight to take advantage of the 501(c)3 deduction?',
		1 => 'From an IRS point of view, the need for transport has to be posted on this site, and the response from pilots also has to be posted. That qualifies the transport as done "for" Pilots N Paws.  You can keep a record of your transport on the <a href="/flightform_fill-inNEW.pdf" style="text-decoration: underline" target="_blank">Pilots N Paws Flight Record</a>.',
	),
	array(
		0 => 'What flight-related expenses can I deduct as a charitable donation?',
		1 => 'Save your receipts for all unreimbursed out of pocket expenses such as fuel, oil, parking fees, landing fees, ramp fees, etc, that are directly related to the transport.   For more information, consult IRS Publication 526 on Charitable Contributions or check with your accountant.

"As you know Pilots n Paws is a 501(c)(3) organization, meaning that those that contribute to it may be entitled to take a charitable deduction in accordance IRS regulations.  Recently, one of our volunteer pilots raised a question as to whether the FAA would consider taking a charitable deduction in the amount of the cost incurred in performing a rescue flight to be “compensation”.  If deductable expenses were considered compensation in the view of the FAA, then rescue flights could not be conducted under Part 91 and the pilot would be in violation of §61.113 by exceeding the limits of his or private pilot certificate.   Through our FAA counsel in Washington D.C. Pilots n Paws sought an interpretation from the FAA’s Chief Counsel’s office in Washington, D.C. on this question and we have been advised that taking a charitable deduction when performing a rescue flight would not be considered compensation by the FAA.  While you should consult your tax advisor regarding tax matters, we can advise you that taking a tax deduction equaling your rescue flight operating expenses, and receiving no other compensation for your efforts, is not inconsistent with FAA regulations.  Here is some additional background information on the question.

 The FAA’s guidance on what constitutes compensation or hire is clear.  The term “compensation” has been interpreted by the FAA as meaning the receipt of anything of value.  One does not need to profit from the enterprise or even receive funds.  Despite this broadly stated position the FAA has, at least since 1993, formally established as a matter of policy an exception regarding tax deductibility under certain circumstances.  This policy is today found in FAA Order 8900.1, Volume 4, Chapter 5, Section 1, Paragraph 4-922 that states:

The FAA’s policy supports “truly humanitarian efforts” to provide life flights to needy persons including “compassionate flights”. This also includes flights involving the transfer of blood and human organs. Since Congress has specifically provided for the tax deductibility of some costs of charitable acts, the FAA will not treat charitable deductions of such costs, standing alone, as constituting “compensation or hire” for the purpose of enforcement of 14 CFR part 61, § 61.118 [now §61.113] or Part 135. Inspectors should not treat the tax deductibility of costs as constituting “compensation or hire” when the flights are conducted for humanitarian purposes.

There was some concern that the use of the word “humanitarian” could be interpreted as only pertaining to the saving of human lives or to the alleviation of human suffering, if one considers the dictionary definition of the term.  As Pilots n Paws pursues a program that is concerned with the welfare and alleviation of suffering of animals, rather than humans, Pilots n Paws, sought and obtained a ruling that the FAA policy on charitable deductions applies to pilots who may take a deduction for expenses associated with the performance of animal rescue flights, should they wish to do so and as permitted under Internal Revenue Code.
 
​If any local FAA Inspector takes a contrary view, please let us know and we will, through our FAA counsel see that the Office of Chief Counsel contacts your local FSDO to advise them of the FAA’s position on this question of FAR interpretation.  "',
	),
	array(
		0 => 'Can I only claim a deduction if the rescue I transport for has 501(c)3 status?',
		1 => 'You can claim a 501(c)3 deduction if the transport is done through Pilots N Paws, regardless of whether the rescue organization is 501(c)3 or not.',
	),
	array(
		0 => 'What is the Pilots N Paws tax ID number, and where do I find your nonprofit listing?',
		1 => 'Www Pilotsnpaws Org Incorporated<br> 
tax ID #26-3754228<br>
<a href="http://tinyurl.com/7a4uzhm" style="text-decoration: underline" target="_blank">IRS Nonprofit listing</a>',
	),
	array(
		0 => '--',
		1 => 'General',
	),
	array(
		0 => 'Should I crate a mom and her pups together or separately?',
		1 => 'Some transport the pups in a crate with Mom tethered, some transport the pups in one crate and the Mom in another, though this really puts a lot of stress on Mom. If the dogs are small and the crate is fairly large, all should be fine together as well. Each situation is different so each must be evaluated individually.  It is always safest to transport one mom and one litter at a time with no other dogs on board, and disinfected crates are always a must between each transport.',
	),
	array(
		0 => 'What is the maximum descent rate when transporting animals?',
		1 => 'There is no hard and fast rule, but you could use 300 fpm as a reasonable target and try not to exceed 500 fpm.  It helps to put "PILOTS N PAWS ANIMAL RESCUE FLIGHT" in the remarks section of the IFR flight plan, and as you are getting handed off to the approach controller, let them know ahead of time you have animals on board and rapid descents can hurt their ears.',
	),
	array(
		0 => 'Are there minimum requirements such as hours flown, IFR certification, etc. before flying missions?',
		1 => 'There are no requirements for Pilots N Paws except the desire to help. The mission of PNP is really just to facilitate communication between those who need an animal transport and those who are willing to transport.',
	),
	array(
		0 => 'How does one get a large dog crate into the back seat of a small low wing plane like a Piper Warrior?',
		1 => 'You put it together inside the plane. One half at a time.',
	),
	array(
		0 => 'How can I keep the inside of the plane clean?',
		1 => 'Definitely ask the rescue volunteer to hold the feeding before flight.  Cover the interior with blankets and towels, and if you want extra protection place a plastic tarp under everything. Anything liquid will hopefully get soaked up by the old blankets, anything that gets through will be stopped by the tarp. Hosing things off is easier than cleaning out the airplane.',
	),
	array(
		0 => 'Should I line the crates with anything or leave them bare?',
		1 => 'The best way to mitigate the impact of an accident (poop, pee, air sickness) is to line the bottom of every crate with a large bath towel or equivalent. That will catch and absorb the worst of it.  Every towel is washed prior to reuse whether it was soiled or not.  At the receiving end of the flight, take all the "linens" and place them in a plastic garbage bag and close it tightly. That way you don\'t have to enjoy the aromas on the return flight. If the crate gets soiled you can use the hose that every FBO seems to have available and flush it out before the return flight.  The crate will not be perfectly clean for reuse, but at least you have flushed away the worst soiling.',
	),
	array(
		0 => 'How should I sanitize the crates between transports?',
		1 => 'Dogs and cats can carry viruses or other illnesses that rescues are unaware of at the time of transport.  Crates should be disassembled, scrubbed with detergent, rinsed clean with water, and disinfected with a solution of diluted bleach or Trifectant.  Plane seats also need to be cleaned.  For more complete information <a href="/forum/parvo.php" style="text-decoration: underline" target="_blank">click here</a>.',
	),
	array(
		0 => 'Should I walk the dogs for a potty break at the airport between flights?',
		1 => '5 minutes spent walking the dogs helps avoid cleanups.  Airport parking lots and off ramp areas work for walking.  Be CAREFUL at towered, TSA-airline airports where you walk on the ramp!  A no-slip collar or harness is preferred.  Shopping bags serve well for "picking up" after them or you can use special doggy waste bags.  Remember the pavement will be extremely hot in high temperatures.  If possible, carry them or have lineserve grab a golf cart and drive them to the lobby or a grass area in hot weather.',
	),
	array(
		0 => 'Are there any problems with tethering animals, such as chewing, fighting, or getting loose?',
		1 => 'I would suggest never transporting tethered animals who are not familiar with each or used to sharing a confined space together. This is not the time or place to introduce them.  Any hostility between dogs prior to a flight where they will be tethered is reason to leave one behind or cancel altogether.  It is also important to ask your rescue contact when transporting if any of the animals are in season. You may need to consider this when transporting animals of opposite genders.  I would also suggest that you use an approved auto safety harness and fit it snugly to the animal. These clasp directly into your back seat belts and though the pup has some room to shift around, they will not end up in your lap. Or use a short leash (3 feet or less) and loop the handle of the leash through the seat belt retainers and slip the end of the leash through the leash handle - then clip it to the harness once the dog is loaded. Tethering with a chain avoids the problem of chewing through a leash.  Some pilots prefer only to fly with dogs contained in hard-sided crates.  It is better to err on the side of caution, especially if you fly alone.  We urge pilots to make decisions with their safety and the safety of the flight foremost in their minds.',
	),
	array(
		0 => 'How can I ensure a dog does not escape from a crate and get loose in the cabin?',
		1 => 'Use hard-sided crates and fasten them with cable ties if you want extra security.  Don\'t forget to bring clippers to cut the cable ties when you reach your destination!',
	),
	array(
		0 => 'What breeds have more trouble with extreme temperatures?',
		1 => 'Certain types of dogs are more sensitive to heat - especially obese dogs and brachycephalic (short-nosed) breeds, like Pugs and Bulldogs. Use extreme caution when these dogs are exposed to heat.  The same is true of short-nosed cats like Persians.  Short-snouted animals can also have difficulty breathing in very cold weather as well. Limited time on the tarmac is best. They should be fine in the aircraft with good ventilation. Always keep in mind it is warmer in a crate!',
	),
	array(
		0 => 'How can I keep the animals cool in hot weather?',
		1 => 'There are several ways you can help keep the animals you are transporting cool. Most FBO\'s are air conditioned and many will allow pets inside, or keep them in the rescue volunteer\'s air conditioned car until you are ready to load them onto the plane. If an air conditioned area is not available, a shady area off the hot tarmac is another choice. Please remember to use a non-slip collar or harness for all dogs you are walking. With snub-nosed dogs, be aware that they need additional precautions in hot weather and cold. For hot weather, a covered cool pac can be placed in the crate with the animal. Be sure this is in a zip lock bag and covered with an absorbent towel. You can also use a small battery operated fan set in front of the crate. A cool pac can be placed between the fan and the crate to allow cool air to flow through the crate. Immediately upon arrival remove the animal from the crate and take them to a cool area. Always make sure there is plenty of air flow in the cabin. The temps are much higher inside the crate than the surrounding area in the cabin. If possible use a crate one size larger than normal with ventilation on all 4 sides for snub-nosed animals.  If the weather is exceptionally cold, keep the animal in a warm area until boarding and include a small towel or blanket in their crate. Shredded newspaper works as well, as it is absorbent and the animals can "nest" in the paper.',
	),
	array(
		0 => 'How do I protect dogs from overheating during transport?',
		1 => '<a href="/forum/overheat.php" style="text-decoration: underline" target ="_blank">Click here</a> to learn how to protect dogs from overheating during transport.',
	),
	array(
		0 => 'Does Pilots N Paws have an official FAA call sign?',
		1 => 'No, not at this time.  The problem is the FAA has no way of verifying we have sufficient monthly activity since we are a bulletin board and we do not require reporting of completed flights. We likely have significantly more transports than required by the regs, but until we make some modifications to our website we cannot document the numbers.  Though PNP does not have its own call sign, you are permitted to use the Compassion call sign because we are a member of Air Care Alliance, should you so desire.',
	),
	array(
		0 => 'Should animals be sedated for the flight?',
		1 => 'Sedating animals is a decision best left to the veterinarians. Almost all animals that are vocal when loaded quiet down and sleep once the plane is running or airborne. Occasionally an animal will bark or yelp or make noises. It is probably not necessary to sedate an animal unless it has some type of behaviour problems or is easily scared. Often talking in a soothing voice to the animal relaxes the animal.',
	),
	array(
		0 => 'What should I know about flying dogs into Canada?',
		1 => '<a href="http://www.inspection.gc.ca/english/anima/imp/petani/canine.shtml" style="text-decoration: underline" target="_blank">Click here</a> to 
learn the requirements for importing dogs into Canada.',
	),
	array(
		0 => 'Can I use a rental plane for transports?',
		1 => 'Several of our pilots rent aircraft. The only requirement for transporting rescue animals is that you have a current pilot\'s license.',
	),
	array(
		0 => 'NOPOG?  No Paws On the Ground?',
		1 => 'Puppies who have not had their full series of vaccinations are vulnerable to diseases such as parvovirus, which can be picked up off the ground at rest stops or anywhere other dogs have been.  The rescue may ask you to let the puppies potty on newspaper or puppy pads in their crate, because it is safer not to let them touch the ground.',
	),
	array(
		0 => 'How does one get a unique ID for a Pilots N Paws flight?',
		1 => 'The unique ID associated with PILOTS N PAWS flights (while carrying the animal(s)) is created by the word CMF followed by the last 3 digits of your aircraft tail number (registration). If you have only 3 digits in your registration, then use those 3 digits.

The unique ID can be used on the spot without any pre-coordination with ATC. You just call them up with your new ID: "Airport ground, Compassion two-alpha-bravo, at the ramp, atis bravo, taxi to ry etc etc..."

You can use CMF### on IFR/VFR flight plans as well.

Do not confuse this with Angel Flight, as AFW has unique IDs associated with the pilot\'s personal registration and no longer the aircraft registration. Angel Flight IDs are not used for PNP flights.',
	),
);

?>