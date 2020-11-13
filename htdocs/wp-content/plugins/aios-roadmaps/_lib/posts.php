<?php

//Build buyers page

$buyer_parent = array(
	'post_title' => 'Buyers',
	'page_name' => sanitize_title_with_dashes('Buyers'),
	'post_content' => '
						[Buyer]
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_category' => array(0)
);

$buyer_parent_id = aios_roadmaps_create_page( $buyer_parent );
			
//Build buyers subpages
$buyer_post[] = array(
	'post_title' => 'Deciding to Buy',
	'page_name'=>sanitize_title_with_dashes('Deciding to Buy'),
	'post_content' => '
						[Buyer]
						
						<p>Purchasing a property is most likely the biggest financial decision you will ever make.  Whether this is your first purchase or you are an experienced buyer, this decision must be made carefully</p>
						<p><h3>Why Do You Want To Buy?</h3>Are you tired of paying rent?  Have you decided to pay your own mortgage and not your landlord&#8217;s?  Have you outgrown your current home?  Are you looking for an investment portfolio?  Are you looking for a rental property?  Would you like a larger yard?  Would you rather live in a different area?  Do you want to shorten your commute?  Having a clear sense of your reasons for buying will help you choose the right property.</p>
						<p><h3>Has Your Income Grown?</h3><p>Property ownership is an excellent investment; whether you are looking for your dream home, a rental property, or to expand your investment portfolio.  Owning real estate is one of the least risky ways to build equity or to obtain a greater return on your initial investment.</p>

	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$buyer_parent_id,
	'post_category' => array(0)
);

$buyer_post[] = array(
	'post_title' => 'Preparing to Buy',
	'page_name'=>sanitize_title_with_dashes('Preparing to Buy'),
	'post_content' => '
						[Buyer]
						<p>Before you start shopping for your property, it is a good idea to make some preparations.</p> 
						<p><h3>Build Your Green File.</h3> 
						A green file contains all your important financial documents. You will need it to secure financing for your property.  The typical green file should contain:</p> 
						<ul>
						<li>Financial statements</li>
						<li>Bank accounts</li> 
						<li>Investments</li>
						<li>Credit cards</li>
						<li>Auto loans</li>
						<li>Recent pay stubs</li>
						<li>Tax returns for two years</li>
						<li>Copies of leases for investment properties</li>
						<li>401K statements, life insurance, stocks, bonds, and mutual account information.</li>
						</ul>
						<p><h3>Check Your Credit Rating.</h3>
						Your credit score will have a huge impact on what type of property you can buy, and at what price.  It is first recommended to check your credit rating with an experienced lending institution so that we can determine what you can afford.  The lender will research your credit ratings from the three credit reporting agencies Equifax, Experian and Trans Union.  We will be happy to recommend experienced, knowledgeable lenders in the residential, construction, and commercial and investment real estate fields.</p> 
						<p><h3>Be Careful With Your Finances.</h3>
						Now is not a good time to make sudden career changes or large purchases. You want to approach your property purchase from a position of financial stability.</p> 
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$buyer_parent_id,
	'post_category' => array(0)
);

$buyer_post[] = array(
	'post_title' => 'Choose a Real Estate Agent',
	'page_name'=>sanitize_title_with_dashes('Choose a Real Estate Agent'),
	'post_content' => '
						[Buyer]
						<p>Buying a property requires making many important financial decisions, understanding complex issues and completing a lot of paperwork. It helps to have an expert in your corner when undertaking such a large purchase. We can guide you through this process, and also provide you with access to property listings before they hit the general market.<br /> 
						Here are some factors to consider when choosing your real estate professional:</p> 
						<ul>
						<li>Look for a full-time agent &ndash; one who has experience completing transactions similar to yours.</li>
						<li>Interview a few agents: Are they familiar with the area in which you are interested?</li>
						<li>Ask how much time the agent will have for you, and if they are available at night and on weekends.</li>
						<li>Ask about their credentials and education: A good agent will continually strive to improve and gain knowledge of the latest real estate trends and hold the highest designations in their respective fields of expertise.</li>
						<li>Does the agent return your calls promptly? Time is money when attempting to buy a property.</li>
						<li>Ask for a list of properties they have sold or a list of references.</li>
						<li>Choose an agent who listens attentively to your needs and concerns.  Pick an agent, with whom you feel comfortable.</li>
						</ul>
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$buyer_parent_id,
	'post_category' => array(0)
);

$buyer_post[] = array(
	'post_title' => 'Time to go Shopping',
	'page_name'=>sanitize_title_with_dashes('Time to go Shopping'),
	'post_content' => '
						[Buyer]
						<p>Once those preparations are out of the way, it is time to find the right property for you.</p> 
						<p><h3>Take a Drive.</h3> 
						Get to know the neighborhoods, complexes, or subdivisions, which interest you.  Drive around and get a feel for what it would be like to own a property in the area. Start getting a sense of the properties available in those areas.</p> 
						<p><h3>Narrow Your Search.</h3>
						Select a few properties that interest you the most and have your real estate agent make appointments to visit them. Ask your real estate agent about the potential long term resale value of the properties you are considering.</p> 
						<p><h3>Time to Buy.</h3>
						Once you have picked out the property you want to purchase, your real estate agent can help you make an offer that the seller will accept. A good agent will investigate the potential costs and expenses associated with the new property.  An agent can also help you draft your offer in a way that gives you the advantage over another offer.</p> 
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$buyer_parent_id,
	'post_category' => array(0)
);

$buyer_post[] = array(
	'post_title' => 'Escrow Inspections and Appraisals',
	'page_name'=>sanitize_title_with_dashes('Escrow Inspections and Appraisals'),
	'post_content' => '
						[Buyer]
						<p><h3>The Process, Step-by-Step</h3></p> 
						<p><h3>The Initial Agreement and Deposit.</h3><br /> 
						An effective agreement is a legal arrangement between a potential purchaser and the property&#8217;s seller.</p> 
						<p>Some important tips to keep in mind to streamline the process:</p> 
						<ul>
						<li>Keep written records of everything.  For the sake of clarity, it will be extremely useful to transcribe all verbal agreements including counter-offers and addendums and to convert them into written agreements to be signed by both parties.  We will assist you in drafting all the paperwork for your purchase and make sure that you have copies of everything.</li> 
						<li>Stick to the schedule. Now that you have chosen your offer, you and the seller will be given a timeline to mark every stage in the process of closing the real estate contract.  Meeting the requirements on time ensures a smoother flow of negotiations so that each party involved is not in breach of their agreements.  During the process we will keep you constantly updated, so you will always be prepared for the next step.</li>
						</ul>
						<p><h3>The Closing Agent.</h3> Either a title company or an attorney will be selected as a closing agent. The closing agent will hold the deposit in escrow and will research the complete recorded history of the property to ensure that the title is free and clear of encumbrances by the date of closing and that all new encumbrances are properly added to the title. Some properties are subject to restrictions which limit various activities such as building or parking restrictions.  There may be recorded easements and encroachments, which limit the rights to use your property.</p> 
						<p><h3>How to Hold Title.</h3> You may wish to consult an attorney or tax advisor on the best way to hold title.  Different methods of holding title have different legal, estate and tax implications, especially when selling or upon death of the title holder.</p> 
						<p><h3>Inspections.</h3> Once your offer is accepted by the seller, you will need to have a licensed property inspector inspect the property within the time frame that was agreed upon in the effective contract to purchase.  You may elect to have different inspectors inspect the property, if you wish to obtain professional opinions from inspectors who specialize in a specific area (eg. roof, HVAC, structure).  If you are purchasing a commercial property, then you will need to have an environmental audit done on the site for the lending institution.  We can recommend several different inspectors.</p> 
						<p>Depending on the outcome of these inspections, one of two things may happen:</p> 
						<p>1.	Either each milestone is successfully closed and the contingencies will be removed, bringing you one step closer to the close, or<br /> 
						2.	The buyer, after reviewing the property and the papers, requests a renegotiation of the terms of contract (usually the price).<br /> 
						<h3>Appraisal and Lending.</h3> It is imperative that you keep in close communication with your lender, who will let you know when additional documents are needed to approve your loan application and fund your loan.  If the agreement is conditional upon financing, then the property will be appraised by a licensed appraiser to determine the value for the lending institution, via a third party.  This is done so that the lending institution can confirm their investment in your property is accurate.  Appraisers are specialists in determining the value of properties, based on a combination of square footage measurements, building costs, recent sales of comparable properties, operating income, etc.  When you are within two weeks of closing, double check with your lender to be sure the loan will go through smoothly and on time.</p> 
						<p><h3>Association Approval.</h3> If the property that you are purchasing is conditional upon an association approval, request the rules, regulations, and other important documents from the seller as soon as you have an effective agreement to purchase.  Make sure that the application documents and processing fees are submitted to the appropriate person at the association by the required time.  Fill out all of the information completely and legibly so there is no delay in processing the application.  If you are required to meet with the association for your approval, make an appointment as soon as possible for the interview.  Most associations require a certificate of approval before move-in.  Your closing agent will request that the original copy of this approval letter be brought to the closing, so that it can be recorded with the deed in the county public records.</p> 
						<p><h3>Property Insurance. </h3>If you are obtaining a loan, you will be required by your lender to purchase a certain amount of insurance on the property.  The value will depend on the lending institution and the purchase price of the property.  You may be able to save hundreds of dollars a year on homeowners insurance by shopping around for insurance.  You can also save money with these tips.</p> 
						<ul>
						<li><strong>Consider a higher deductible. </strong>Increasing your deductible by just a few hundred dollars can make a big difference in your premium.</li>
						<li><strong>Ask your insurance agent about discounts. </strong>You may be able get a lower premium if your home has safety features such as dead-bolt locks, smoke detectors, an alarm system, storm shutters or fire-retardant roofing materials. Persons over 55 years of age or long-term customers may also be offered discounts.</li>
						<li><strong>Insure your house NOT the land under it. </strong>After a disaster, the land is still there. If you do not subtract the value of the land when deciding how much homeowner&rsquo;s insurance to buy, you will pay more than you should.</li>
						We will be happy to recommend experienced knowledgeable insurance agents for every property type.</p> 
						</ul>
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$buyer_parent_id,
	'post_category' => array(0)
);

$buyer_post[] = array(
	'post_title' => 'Moving In',
	'page_name'=>sanitize_title_with_dashes('Moving In'),
	'post_content' => '
						[Buyer]
						<p><h3>Closing Day</h3> 
						If you have come this far, then this means that it is almost time for a congratulations, but not yet.  Do not forget to tie up these loose ends:</p> 
						<p><h3>Final Walk-Through Inspection.</h3>
						More of a formality than anything else, the final inspection takes place a day before, or the day of the closing. You will visit the property to verify that all is in working order, everything is the same as when you last viewed the property, that there are no extra items left behind, and that everything included in your purchase is still at the property.</p> 
						<p><h3>Home Services and Utilities.</h3>
						We will provide a list of useful numbers for the activation of home services and utilities after the closing occurs.</p> 
						<p><h3>Be Prepared.</h3>
						We are ready to assist you should an unforeseen glitch pop up, even at this last stage. Something at the property breaks down, or some other minor detail &#8211; no need to worry. We have encountered these problems before so we know how to handle them efficiently and in a stress-free manor.</p> 
						<p><h3>Closing.</h3>
						The closing agent will furnish all parties involved with a settlement statement, which summarizes and details the financial transactions enacted in the process. You and the seller(s) will sign this statement, as well as the closing agent, certifying its accuracy. If you are obtaining financing, you will have to sign all pertinent documentation required by the lending institution.  If you are unable to attend the scheduled closing, arrangements can be made depending on the circumstances and the notice that we receive.  If you are bringing funds to the transaction, you can elect to either have the funds wired electronically into the closing agent&rsquo;s escrow account, or bring a certified bank check to the closing in the amount specified on the settlement statement.  The seller should arrange to have all property keys and any other important information for you at the closing so that you may receive these items at this time.</p>
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$buyer_parent_id,
	'post_category' => array(0)
);

$buyer_ids = array();

foreach($buyer_post as $new_buyer){
	
	$buyer_ids[] = aios_roadmaps_create_page( $new_buyer );
	
}
$buyer_serialized = serialize( $buyer_ids );
	
	
//Build sellers page

$seller_parent = array(
	'post_title' => 'Sellers',
	'page_name'=>sanitize_title_with_dashes('Sellers'),
	'post_content' => '
						[Seller]
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_category' => array(0)
);

$seller_parent_id = aios_roadmaps_create_page( $seller_parent );

//Build sellers subpages

$seller_post[] = array(
	'post_title' => 'Decide to Sell',
	'page_name'=>sanitize_title_with_dashes('Decide to Sell'),
	'post_content' => '
						[Seller]
						<p>So you have decided to sell your property.  Before anything else, it is a good idea to sit down and clarify your motivations and draw up a basic time frame for the selling process.</p> 
						<p><h3>Why Sell?</h3>  
						Why do you want to sell your property?  Do you intend to simply find a larger property, or do you plan on moving to another neighborhood, school district, city or state?  You might think your reasons are obvious, but it would do well to consider the implications of each option for your lifestyle, opportunities, and finances.  Being clear about your intentions for selling will make it easier for us to determine the most appropriate option for your specified financial, lifestyle, and real estate goals.</p> 
						<p><h3>When Should I Sell?</h3> 
						You should immediately establish your time frame for selling.  If you need to sell quickly, we can speed up the process by giving you a complete market analysis and action plan to obtain all of your goals.  If there is no pressing need to sell immediately, you can sit down with one of our expert real estate agents to thoroughly review the current market conditions and find the most favorable time to sell.</p> 
						<p><h3>What Is The Market Like?</h3>
						When you work with us, you can be sure that you will have our knowledge, expertise and negotiating skills at work for you to arrive at the best market prices and terms.  We will keep you up-to-date on what is happening in the marketplace and the price, financing, terms and conditions of competing properties.  With us, you will know exactly how to price and when to sell your property.</p> 
						<p><h3>How Do I Optimize My Finances?</h3>
						Deciding to sell your property demands a serious consideration of your current financial situation and future possibilities. With the help of our qualified agents, you will be able to effectively assess the cumulative impact of these changes, estimate potential proceeds of selling your property, and plan effective tax savings and estate planning strategies.  We will ensure that you not only take control of your finances, but use them to their fullest potential.</p>
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$seller_parent_id,
	'post_category' => array(0)
);

$seller_post[] = array(
	'post_title' => 'Select An Agent and Price',
	'page_name'=>sanitize_title_with_dashes('Select An Agent and Price'),
	'post_content' => '
						[Seller]
						<p><strong>Why Should You Choose Our Professionals?</strong><br /> 
						You may opt to sell your property independently.  There are many excellent reasons, however, why you should choose us to assist you in this important undertaking.  We will ensure that you maximize your opportunities in the current real estate market.  With our extensive contact networks that we have developed through the many national and international organizations, of which we are members, as well as our current and past clients, we will employ the most effective marketing and advertising strategies for your property.  We will also guide you through the complicated paperwork involved, from the initial agreement to the final documents.<br /> 
						<br /> 
						<strong>What To Look For In An Agent.</strong><br /> 
						The following are a couple of factors to keep in mind when looking for a listing agent:<br /> 
						<br /> 
						1. <strong>Education. </strong> The most important factor in choosing a real estate professional is their education in the real estate industry.  Our professionals have advanced training and education, allowing them to be among the top agents in the world and earning prestigious designations in the various fields of real estate.</p> 
						<p>2. <strong>Experience and Expertise.</strong> You want a full-time agent who is familiar with your area and with the type of property you intend to sell.  Does he or she employ a diverse range of marketing and advertising strategies?  How tech-savvy is your agent?  How many similar properties has he or she been able to sell in the past?</p> 
						<p>3. <strong>Availability and Commitment.</strong> Your agent should be capable of prompt and decisive action during the course of selling your property.  Does your agent make it a point to keep in touch with you constantly?  Can your agent easily be contacted in case of emergencies or even for the simplest questions?  Is your agent available on the weekends or in the evenings when most buyers are out looking?</p> 
						<p>4. <strong>Rapport.</strong> Does your agent take the time to listen to your goals and clarify your needs?  Can your agent understand your unique situation and be genuinely concerned about the outcome of the process?  Your listing agent will be your guide and partner in this crucial decision, so it is important to find one with whom you can get along.</p> 
						<p><strong>What Is Your Property Worth?</strong><br /> 
						Without a professional agent, most independent property sellers tend to overestimate the value of their property.  You can avoid this pitfall by consulting with an experienced real estate listing agent.</p> 
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$seller_parent_id,
	'post_category' => array(0)
);

$seller_post[] = array(
	'post_title' => 'Prepare to Sell',
	'page_name'=>sanitize_title_with_dashes('Prepare to Sell'),
	'post_content' => '
						[Seller]
						<p>You can do a lot to increase the appeal of your property and to create a lasting impact on potential buyers.</p> 
						<p><strong>What To Do To Prepare:</strong></p> 
						<p>The following are a couple of factors to keep in mind when listing your property for sale:<br /> 
						1.  <strong>Curb Appeal.</strong><br /> 
						Keeping your landscape pristine, and adding creative touches to your yard, such as colorful annuals, will create an immediate impact on passers-by and potential buyers.</p> 
						<p>2.  <strong>Property Repairs.</strong><br /> 
						Simple upgrades such as window repairs, polishing the doorknobs, and a fresh coat of paint in the most frequently used rooms will instantly brighten up the property.</p> 
						<p>3.  <strong>Cleanliness and Staging.</strong><br /> 
						Keep your property uncluttered, sweet-smelling and well-lit from top-to-bottom. Pay attention to details:  put away the kitty litter, place a vase of fresh flowers near the entryway, pop a batch of cinnamon rolls in the oven, have your carpets cleaned.  Your agent will scan the property before it is listed for sale to see how you can improve the staging of your property.</p> 
						<p>4.  <strong>Disclosures and Inspections.</strong><br /> 
						We are very familiar with the legal procedures involved in disclosures and are ready to help you develop a thorough disclosure statement beneficial to both you and the buyer, as well as suggest home improvement measures before placing your property on the market (such as termite and pest inspections).</p> 
						<p>5.  <strong>Showtime.</strong><br /> 
						Presenting your property to potential buyers is a job that we will take care of for you. Buyers feel more comfortable discussing the property with the agent, if you are not there. Moreover, your agent will know what information will be most useful in representing your interests when speaking with prospective buyers.</p> 
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$seller_parent_id,
	'post_category' => array(0)
);

$seller_post[] = array(
	'post_title' => 'Accepting an Offer',
	'page_name'=>sanitize_title_with_dashes('Accepting an Offer'),
	'post_content' => '
						[Seller]
						<p><h3>The Price Is Not Always Right.</h3> 
						&#8220;The higher the price, the better the offer.&#8221;  Do not let yourself be fooled by this popular misconception.  Price is not always the determining factor when accepting an offer for several important reasons: the initial offer is usually not final, and there are a number of terms and conditions that may influence the final outcome of a price.  You can trust our professionals to help you thoroughly evaluate every proposal without compromising your marketing position.</p> 
						<p><h3>Negotiating The Right Way.</h3> 
						We take the ethical responsibility of fairly negotiating contractual terms very seriously.  It is our job to find a win-win agreement that is beneficial to all parties involved.  You may even have to deal with multiple offers before ratifying the one you judge to be the most suitable for you &#8211; and as your agents, we will guarantee a thorough and objective assessment of each offer to help you make the right choice.</p> 
						<p><h3>The Initial Agreement and Deposit.</h3>  
						An effective agreement is a legal arrangement between a potential purchaser and the property&rsquo;s seller.  Laws vary from state to state, but in order to be a legally, binding agreement, the agreement may require consideration.  This consideration (initial and additional deposit) is to be held in the closing agent&rsquo;s escrow account pending the fulfillment of conditions or contingencies in the effective agreement.</p> 
						<p>Some important tips to keep in mind to streamline the process even further:</p> 
						<ul>
						<li><strong>Keep written records of everything.</strong> 
						For the sake of clarity, it will be extremely useful to transcribe all verbal agreements including counter-offers and addendums, and convert them to written agreements to be signed by both parties.  We will assist you in drafting all the paperwork for your sale and make sure that you have copies of everything.</li> 
						<li><strong>Stick to the schedule.</strong>  
						Now that you have chosen your offer, you and the buyer will be given a timeline to mark every stage in the process of closing the real estate contract.  Meeting the requirements on time ensures a smoother flow of negotiations and also ensures that each party involved is not in breach of their agreements.  During the process we will keep you constantly updated so you will always be prepared for the next step.</li>
						</ul>
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$seller_parent_id,
	'post_category' => array(0)
);

$seller_post[] = array(
	'post_title' => 'Escrow Inspections and Appraisals',
	'page_name'=>sanitize_title_with_dashes('Escrow Inspections and Appraisals'),
	'post_content' => '
						[Seller]
						<p><strong>Inspections and Appraisals</strong><br /> 
						Most buyers will have the property inspected by a licensed property inspector within the time frame that was agreed upon in the effective contract to purchase. Some buyers will have several different inspectors inspect the property, if they wish to obtain professional opinions from inspectors who specialize in a specific area (eg. roof, HVAC, structure).  If the agreement is conditional upon financing, then the property will be appraised by a licensed appraiser to determine the value for the lending institution via third party.  This is done so that the lending institution can confirm their investment in your property is accurate.  A buyer of a commercial property may also have a complete environmental audit performed and/or soil test, if required by the lending institution.</p> 
						<p><strong>The Closing Agent.</strong><br /> 
						Either a title company or an attorney will be selected as the closing agent, whose job is to examine and insure clear title to real estate.  After researching the complete recorded history of your property, they will certify that 1) your title is free and clear of encumbrances (eg. mortgages, leases, or restrictions, liens) by the date of closing; and 2) all new encumbrances are duly included in the title.</p> 
						<p><strong>Contingencies.</strong><br /> 
						A contingency is a condition that must be met before a contract becomes legally binding.  For instance, a buyer will usually include a contingency stating that their contract is binding only when there is a satisfactory home inspection report from a qualified inspector.</p> 
						<p>Before completing his or her purchase of your property, the buyer goes over every aspect of the property, as provided for by purchase agreements and any applicable addendums.  These include:</p> 
						<ul>
						<li>Obtaining financing and insurance;</li> 
						<li>Reviewing all pertinent documents, such as preliminary title reports and disclosure documents; and</li>
						<li>Inspecting the property. The buyer has the right to determine the condition of your property by subjecting it to a wide range of inspections, such as roof, termite/pest, chimney/fireplace, property boundary survey, well, septic, pool/spa, arborist,  mold, lead based paint, HVAC, etc.</li>
						</ul>
						<p>Depending on the outcome of these inspections, one of two things may happen:</p> 
						<p>1.	Either each milestone is successfully closed and the contingencies will be removed, bringing you one step closer to the closing; or<br /> 
						2.	The buyer, after reviewing the property and the papers, requests a renegotiation of the terms of contract (usually the price).<br /> 
						How do you respond objectively and fairly to the buyer when a renegotiation is demanded, while acting in your best interests?  This is when a professional listing agent can make a real difference in the outcome of the transaction.  Having dealt with various property sales in the past, we guarantee our expertise and total commitment to every customer, no matter what their situation is.</p> 
						<p><strong>Loan Approval and Appraisal.</strong><br /> 
						We suggest that you accept buyers who have a lender&#8217;s pre-approval, approval letter, or written loan commitment, which is a better guarantee of loan approval than a pre-qualification or no documentation from a lending institute.  Expect an appraiser from the lender&#8217;s company to review your property and verify that the sales price is appropriate.</p> 
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$seller_parent_id,
	'post_category' => array(0)
);

$seller_post[] = array(
	'post_title' => 'Close of Escrow',
	'page_name'=>sanitize_title_with_dashes('Close of Escrow'),
	'post_content' => '
						[Seller]
						<p><h3>Closing Day</h3>  
						If you have come this far, this means that it is almost time for a congratulations, but not yet.  Do not forget to tie up these loose ends:</p> 
						<p><h3>Final Walk-Through Inspection.</h3> 
						More of a formality than anything else, the final inspection takes place the day before, or the day of the closing.  The buyer visits the property to verify that all is in working order, everything is the same as when the buyer last viewed the property, and that there are no extra items left behind.</p> 
						<p><h3>Cancel Home Services and Utilities.</h3> 
						We will provide a list of useful numbers for the termination of home services and utilities after the closing occurs.</p> 
						<p><h3>Be Prepared.</h3> 
						We are ready to assist you should an unforeseen glitch pop up, even at this last stage. If something at the property breaks down or the buyers&#8217; loan does not pull through on time, there is no need to worry. We have encountered these problems before so we know how to handle them efficiently and in a stress-free manner.</p> 
						<p><h3>Closing.</h3>
						The closing agent will furnish all parties involved with a settlement statement, which summarizes and details the financial transactions enacted in the process. The buyer(s) will sign this statement and then you will sign as well as the closing agent, certifying its accuracy.  If you are unable to attend the scheduled closing, then arrangements can be made depending on the circumstances and the notice that we receive.  If you are receiving funds from the transaction, you can elect to either have the funds wired electronically to an account at your financial institution, or have a check issued to you at the closing.  The seller should arrange to have all property keys and any other important information for the new purchaser at the closing, so that the purchaser may receive these items at this time.</p> 
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$seller_parent_id,
	'post_category' => array(0)
);

$seller_ids = array();

foreach($seller_post as $new_seller){
	
	$seller_ids[] = aios_roadmaps_create_page( $new_seller );
	
}
$seller_serialized = serialize( $seller_ids );

//Build financing page

$financing_parent = array(
	'post_title' => 'Financing Options',
	'page_name'=>sanitize_title_with_dashes('Financing Options'),
	'post_content' => '
						[Financing]'
						,
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_category' => array(0)
);

$financing_parent_id = aios_roadmaps_create_page( $financing_parent );

//Build financing subpages

$financing_post[] = array(
	'post_title' => 'Financing Options',
	'page_name'=>sanitize_title_with_dashes('Financing Options'),
	'post_content' => '
						[Financing]
						<h3>Start A Green File </h3>
						<p>A Green File should contain all of your important financial documents. Regardless of the loan type, lenders will need information about you. Make copies of financial statements; bank accounts, investments, credit cards, auto loans, recent pay stubs and two years&#8217; tax returns. </p> 
						<h3>Check Your Credit Rating </h3> 
						<p>Credit scores range between 400 and 800. 620 + is considered &quot;good&quot;. 680 + is considered &quot;premium&quot; and may possibly help get you a lower interest rate. </p> 
						<p>Below you will find the contact information for the 3 major credit reporting agencies to help you determine your credit rating. Ask your lender how to improve your credit score if you need to. Going forward, treat your credit like gold. </p> 
						<table cellspacing="1" cellpadding="4" style="color:#000000;" class="roadmap-table-responsive"> 
						<tr bgcolor="#ECECEC"> 
						<td>Equifax </td> 
						<td align="middle"><a target="_blank" href="http://www.equifax.com" style="color:#000000;">http://www.equifax.com </a></td> 
						<td align="middle"> [ai_phone href="+18006851111"]800.685.1111[/ai_phone] </td> 
						</tr> 
						<tr bgcolor="#ECECEC"> 
						<td>Experian </td> 
						<td align="middle"><a target="_blank" href="http://www.experian.com" style="color:#000000;">http://www.experian.com </a></td> 
						<td align="middle">[ai_phone href="+18003921122"]800.392-1122 [/ai_phone]</td> 
						</tr> 
						<tr bgcolor="#ECECEC"> 
						<td>Trans Union </td> 
						<td align="middle"><a target="_blank" href="http://www.transunion.com" style="color:#000000;">http://www.transunion.com </a></td> 
						<td align="middle">[ai_phone href="+18008884213"]800.888-4213 [/ai_phone]</td> 
						</tr> 
						</table> 
						<h3 align="left">Savings &amp; Debt </h3> 
						<p>If you are buying real estate, try to accumulate funds towards your down payment, closing costs (appraisal, miscellaneous fees, escrow, title insurance, etc.) and expenses such as inspections. Furthermore, try to pay down existing revolving and high interest rate debt like credit cards.
						 </p> 
						<h3 align="left">Toe The Line </h3> 
						<p align="left"> Now is not a good time to change careers, move your money around, or buy big ticket items. Lenders like stability. So if you are considering any major changes, it pays to meet with a lender and ask them how to proceed before you make any changes! If you are tempted to buy a big ticket item, consider the following: </p> 
						<table cellspacing="1" cellpadding="4"> 
						<tr> 
						<td bgcolor="#ECECEC" style="color:#000000;">A $500 a month debt payment (like a credit card or auto loan) could lower the amount of home you can afford by about $83,000! <font color="#CC0000">*</font> </td> 
						</tr> 
						</table> 
						<table cellspacing="0" cellpadding="0"> 
						<tr> 
						<td></td> 
						</tr> 
						</table> 
						<p><font color="#CC0000">*</font> Based on a 30 year mortgage at 6% interest.</p> 
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$financing_parent_id,
	'post_category' => array(0)
);

$financing_post[] = array(
	'post_title' => 'Shop for a Loan',
	'page_name'=>sanitize_title_with_dashes('Shop for a Loan'),
	'post_content' => '
						[Financing]
						<h3>How to Find a Lender </h3> 
						<p> Today, lenders can be found through a variety of sources. In addition to calling on ads in the newspaper, you can also find and apply to lenders over the internet, and through referrals from your REALTOR. We would be happy to suggest lenders we have used successfully, who have proven themselves competitive and capable even with problem properties or poor credit.</p> 
						<h3>Choosing the Right Lender</h3> 
						<p>Interview several lenders to evaluate the following:</p> 
						<ul> 
						<li> Ability to explain things clearly and return your phone calls in a reasonable time period</li> 
						<li> Competitiveness of interest rates, costs &amp; fees. </li> 
						<li>Availability of loan programs that suit your credit profile and desired property </li> 
						<li>Access to local loan approval committee that understands the kind of property you are buying</li> 
						</ul> 
						<h3>Choosing the Right Kind of Loan </h3> 
						<p>Today there are so many types of loans on the market that it is beyond the scope of this page to list or explain them all. Your lender is the best person to help you select a loan program to suit your needs. Below is a summary of the three most popular loan types we see in practice; for more detailed information click the link at the end of this page. </p> 
						<ol> 
						<li> <u><strong>Fixed loan:</strong> </u>The fixed rate loan assures your monthly payments will stay the same over the life of the loan, which is typically between 15 and 30 years. Fixed rate loans may be best if you intend to hold the property for a long period of time, say over 7 years.</li> 
						<li> <u><strong>ARMs (adjustable rate mortgages):</strong></u> ARM&rsquo;s may be suitable if you plan to sell or refinance your home within the next few years. The starting interest rate is typically lower than a fixed rate loan, saving you money initially. However, it is important to understand the index, the readjustment interval, the capitalization rate and downside risks of an ARM before making a final decision to use this type of loan.</li> 
						<li> <u><strong>Intermediate ARMs:</strong></u> Also called <em>Hybrid Loans</em>, these loans can offer fixed interest rates for the first 3, 5, 7 or 10 years after which the interest rate adjusts with the market every 6 months or year thereafter. </li> 
						</ol> 
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$financing_parent_id,
	'post_category' => array(0)
);

$financing_post[] = array(
	'post_title' => 'Know the Numbers',
	'page_name'=>sanitize_title_with_dashes('Know the Numbers'),
	'post_content' => '
						[Financing]
						<h3>Credit Report</h3> 
						<p>Typically, it costs under $50 to check your credit. With your permission the lender will order a review of your outstanding loans and your repayment history from a third party credit agency.</p> 
						<h3> 
						Application / Processing Fee</h3> 
						<p>This cost, typically a few hundred dollars, is charged to cover the lender&rsquo;s work to evaluate your ability to repay the loan. Some lenders will credit this back to you upon closing.</p> 
						<h3> 
						What is APR?</h3> 
						<p>The APR, or annual percentage rate, is the sum total of all your borrowing costs expressed as a percentage interest rate charged on the loan balance.</p> 
						<table width="100%" border="0" cellpadding="4" cellspacing="1"> 
						<tbody> 
						<tr valign="top" align="left"> 
						<td bgcolor="#ECECEC" style="color:#000000;"><u>For example</u>: After fees, the original interest rate quote of 5.875% might work out to a 6% APR loan, where the interest costs about $6,000 per year for every $100,000 borrowed, and the principal payments are calculated based on the length of the loan term (for example 15, 20, or 30 years). </td> 
						</tr> 
						</tbody> 
						</table> 
						<h3> Indexes</h3> 
						<p>The interest rates on variable loans readjust periodically based on changes in an index. Typical indexes include the Federal Funds Rate, Treasury Bill.</p> 
						<h3 align="left">Points</h3> 
						<p align="left">When mortgage companies are competing by offering lower interest rates, they may charge you a one-time pre-paid interest payment calculated as a percentage of the loan. Called points&quot;, this may range from 0.25% to 2% of the loan balance, and is usually paid up front. Points are tax-deductible; consult with your tax advisor.</p> 
						<h3>Appraisal Cost</h3> 
						<p> Lenders hire experienced, often independent appraisers to evaluate the property&rsquo;s purchase price, condition and size compared to similar recent neighborhood sales. This helps ensure the purchase price is not too high, and gives the lender more confidence in getting repaid in the event they are forced to sell the property if the borrower defaults. The appraisal costs vary depending on the property, type of appraisal, and region.</p> 
						<h3>Miscellaneous Fees</h3> 
						<p>Expect to see various charges incurred in the processing of your loan which might include notary, courier, and county recording fees.</p> 
						<h3>Prepayment Penalties</h3> 
						<p>These vary widely, so be sure you know in advance if your lender will charge a penalty if you refinance or sell, and the certain period during which the penalties apply.</p> 
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$financing_parent_id,
	'post_category' => array(0)
);

$financing_post[] = array(
	'post_title' => 'Get Pre-Approved',
	'page_name'=>sanitize_title_with_dashes('Get Pre-Approved'),
	'post_content' => '
						[Financing]
						<h3>Does it Help to be Pre-Qualified by a Lender?</h3> 
						<p> The pre-qualification process can be completed fairly quickly, based on less information than is required for getting pre-approved. While it is fast and it does help, a pre-qualification letter is an opinion from a lender of the maximum amount of real estate you can qualify for. In a competitive seller&rsquo;s market, an offer from a buyer with a pre-qualification letter could lose out to a person who is pre-approved.</p> 
						<h3>Get Pre-Approved by a Lender</h3> 
						<p>There are several benefits to going the extra mile and getting a pre-approval letter. First of all, you will know exactly how much real estate you can afford. When you find a property you want to buy, your offer will be in a better positioned than someone less prepared. Finally, being pre-approved is more efficient; it reduces the amount of time it will take your lender to fund your loan. Be prepared to provide comprehensive documentation, which the lender may independently verify, including but not limited to:</p> 
						<ul> 
						<li>Job and career status</li> 
						<li>Income</li> 
						<li>Monthly debt payments</li> 
						<li>Cash available</li> 
						<li>Total assets and debts </li> 
						</ul> 
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$financing_parent_id,
	'post_category' => array(0)
);

$financing_post[] = array(
	'post_title' => 'Applications & Processing',
	'page_name'=>sanitize_title_with_dashes('Applications & Processing'),
	'post_content' => '
						[Financing]
						<h3>Mortgage Brokers and Lenders &ndash; Who Does What?</h3> 
						<p>The mortgage broker is the person or company who is your main contact throughout your loan. They are often able to work with a number of lenders, who actually provide the funds for the loan. Typically, the lender pays the mortgage broker a fee for acting as the intermediary and providing all the customer service.</p> 
						<h3> 
						Filling Out the Application</h3> 
						<p>There are standard forms to be completed when applying for a loan. Some mortgage brokers keep these on their website so you can fill out and submit the forms on line. The information will be verified and used to qualify you for your loan, so take the time to answer questions accurately.</p> 
						<h3>Documentation</h3> 
						<p>The mortgage broker will need copies of the documents you began gathering in the first phase of the loan process, including:</p> 
						<ul> 
						<li>Either 2 years of W-2 forms from your employer or 2 years of tax returns if you are self-employed</li> 
						<li>Recent pay stubs</li> 
						<li> 3 months bank and money market statements</li> 
						<li> Brokerage, mutual fund and retirement account statements</li> 
						<li> Proof of other income sources (alimony, trusts, rental income, etc.)</li> 
						<li> Credit card statements</li> 
						<li> Auto /boat / student / miscellaneous loans </li> 
						<li>Drivers&rsquo; license or form of ID</li> 
						<li> If you&rsquo;re not a US citizen, then copy of your green card or visa</li> 
						<li> Copy of any existing mortgage debts if you are applying for a home equity line of credit or another mortgage</li> 
						</ul> 
						<h3>Stay in Communication</h3> 
						<p>The lender will have an analyst, usually called an &quot;underwriter&quot;, crunch your numbers and verify your documentation to confirm your ability to repay the loan. Once you are in contract on a property, there may<br /> 
						  also be a loan approval committee which will meet to review the underwriters&#8217; conclusions regarding your creditworthiness, and to evaluate the property on which they are lending. This is called the underwriting process, and questions<br /> 
						  are bound to arise. Be sure to return your mortgage broker&rsquo;s calls promptly to keep the process moving forward smoothly. Check in with your broker periodically.</p> 
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$financing_parent_id,
	'post_category' => array(0)
);

$financing_post[] = array(
	'post_title' => 'Funding',
	'page_name'=>sanitize_title_with_dashes('Funding'),
	'post_content' => '
						[Financing]
						<h3>The Signing</h3> 
						<p> When the lender is ready to &#8220;close&#8221; your loan, or &#8220;fund&#8221; it, your real estate agent and your mortgage broker will have you sign the final loan documents. Signing will typically take place in front of a notary or an escrow officer. Ask your mortgage broker if there is anything you need to do to prepare for this, such as bringing a photo ID or perhaps a cashiers&#8217; check if you are purchasing real estate. Allow yourself enough time to review  the documents for accuracy.</p> 
						<table width="100%" border="0" cellpadding="4" cellspacing="1"> 
						<tbody> 
						<tr valign="top" align="left"> 
						<td bgcolor="#ECECEC" style="color:#000000;"> 
						<u><strong>If funds are being wired:</strong></u> &#8220;Wiring instructions&#8221; direct the electronic transfer of money between financial companies. If possible, arrange to have the wiring instructions in place ahead of time and checked for accuracy by both the sender and recipient of the wire. It is critical that these instructions be exact, and even so, delays are all too common.</td> 
						</tr> 
						</tbody> 
						</table> 
						<h3>Congratulations!</h3> 
						<p>Your mortgage broker will probably call you to confirm that the money has been transferred and the loan has closed. Always follow up with a phone call to confirm that your loan funds went where they were supposed to go. It is a good idea to keep records of this critical phase of the transaction once completed.</p>
	',
	'post_status' => 'publish',
	'comment_status' => 'closed',
	'post_author' => $user_ID,
	'post_type' => 'page',
	'post_parent' =>$financing_parent_id,
	'post_category' => array(0)
);

$financing_ids = array();

foreach($financing_post as $new_financing){
	
	$financing_ids[] = aios_roadmaps_create_page( $new_financing );
	
}
$financing_serialized = serialize( $financing_ids );
	
