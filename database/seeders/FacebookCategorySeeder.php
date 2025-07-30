<?php

namespace Database\Seeders;

use App\Models\FacebookCategory;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacebookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Abortion Service',
            ],
            [
                'category_name' => 'Abruzzo Restaurant',
            ],
            [
                'category_name' => 'Academic Camp',
            ],
            [
                'category_name' => 'Accessories',
            ],
            [
                'category_name' => 'Accountant',
            ],
            [
                'category_name' => 'Acehnese Restaurant',
            ],
            [
                'category_name' => 'Actor',
            ],
            [
                'category_name' => 'Acupuncturist',
            ],
            [
                'category_name' => 'Addiction Resources Center',
            ],
            [
                'category_name' => 'Addiction Service',
            ],
            [
                'category_name' => 'Addiction Treatment Center',
            ],
            [
                'category_name' => 'Adoption Service',
            ],
            [
                'category_name' => 'Adult Entertainment Service',
            ],
            [
                'category_name' => 'Aerospace Company',
            ],
            [
                'category_name' => 'Afghan Restaurant',
            ],
            [
                'category_name' => 'African Methodist Episcopal Church',
            ],
            [
                'category_name' => 'African Restaurant',
            ],
            [
                'category_name' => 'AIDS Resource Center',
            ],
            [
                'category_name' => 'Aircraft Manufacturer',
            ],
            [
                'category_name' => 'Airline Company',
            ],
            [
                'category_name' => 'Airline Industry Service',
            ],
            [
                'category_name' => 'Airport',
            ],
            [
                'category_name' => 'Airport Gate',
            ],
            [
                'category_name' => 'Airport Lounge',
            ],
            [
                'category_name' => 'Airport Shuttle Service',
            ],
            [
                'category_name' => 'Airport Terminal',
            ],
            [
                'category_name' => 'Album',
            ],
            [
                'category_name' => 'Alcohol Addiction Treatment Center',
            ],
            [
                'category_name' => 'Allergist',
            ],
            [
                'category_name' => 'Alternative & Holistic Health Service',
            ],
            [
                'category_name' => 'Amateur Photographer',
            ],
            [
                'category_name' => 'Amateur Sports League',
            ],
            [
                'category_name' => 'Amateur Sports Team',
            ],
            [
                'category_name' => 'American Restaurant',
            ],
            [
                'category_name' => 'Andhra Restaurant',
            ],
            [
                'category_name' => 'Anesthesiologist',
            ],
            [
                'category_name' => 'Anglican Church',
            ],
            [
                'category_name' => 'Anhui Restaurant',
            ],
            [
                'category_name' => 'Animal Rescue Service',
            ],
            [
                'category_name' => 'Animal Shelter',
            ],
            [
                'category_name' => 'Animation Studio',
            ],
            [
                'category_name' => 'Antique Store',
            ],
            [
                'category_name' => 'Aosta Restaurant',
            ],
            [
                'category_name' => 'Apartment & Condo Building',
            ],
            [
                'category_name' => 'Apostolic Church',
            ],
            [
                'category_name' => 'App Page',
            ],
            [
                'category_name' => 'Apparel & Clothing',
            ],
            [
                'category_name' => 'Apparel Distributor',
            ],
            [
                'category_name' => 'Appliance Manufacturer',
            ],
            [
                'category_name' => 'Appliance Repair Service',
            ],
            [
                'category_name' => 'Appliance Store',
            ],
            [
                'category_name' => 'Appliances',
            ],
            [
                'category_name' => 'Aquatic Pet Store',
            ],
            [
                'category_name' => 'Arabian Restaurant',
            ],
            [
                'category_name' => 'Arboretum',
            ],
            [
                'category_name' => 'Archaeological Service',
            ],
            [
                'category_name' => 'Archery Range',
            ],
            [
                'category_name' => 'Archery Shop',
            ],
            [
                'category_name' => 'Architectural Designer',
            ],
            [
                'category_name' => 'Architectural Tour Agency',
            ],
            [
                'category_name' => 'Argentinian Restaurant',
            ],
            [
                'category_name' => 'Armed Forces',
            ],
            [
                'category_name' => 'Armenian Restaurant',
            ],
            [
                'category_name' => 'Aromatherapy Service',
            ],
            [
                'category_name' => 'Art',
            ],
            [
                'category_name' => 'Art Restoration Service',
            ],
            [
                'category_name' => 'Art School',
            ],
            [
                'category_name' => 'Art Tour Agency',
            ],
            [
                'category_name' => 'Article',
            ],
            [
                'category_name' => 'Artist',
            ],
            [
                'category_name' => 'Arts & Crafts Store',
            ],
            [
                'category_name' => 'Arts & Humanities Website',
            ],
            [
                'category_name' => 'Asian Fusion Restaurant',
            ],
            [
                'category_name' => 'Asian Restaurant',
            ],
            [
                'category_name' => 'Assemblies of God',
            ],
            [
                'category_name' => 'Astrologist',
            ],
            [
                'category_name' => 'Astrologist & Psychic',
            ],
            [
                'category_name' => 'Athlete',
            ],
            [
                'category_name' => 'ATV Recreation Park',
            ],
            [
                'category_name' => 'ATV Rental',
            ],
            [
                'category_name' => 'Auction House',
            ],
            [
                'category_name' => 'Audio Visual Equipment Store',
            ],
            [
                'category_name' => 'Audiologist',
            ],
            [
                'category_name' => 'Australian Restaurant',
            ],
            [
                'category_name' => 'Austrian Restaurant',
            ],
            [
                'category_name' => 'Author',
            ],
            [
                'category_name' => 'Auto Detailing Service',
            ],
            [
                'category_name' => 'Automated Teller Machine (ATM)',
            ],
            [
                'category_name' => 'Automation Service',
            ],
            [
                'category_name' => 'Automotive Body Shop',
            ],
            [
                'category_name' => 'Automotive Consultant',
            ],
            [
                'category_name' => 'Automotive Customization Shop',
            ],
            [
                'category_name' => 'Automotive Glass Service',
            ],
            [
                'category_name' => 'Automotive Leasing Service',
            ],
            [
                'category_name' => 'Automotive Manufacturer',
            ],
            [
                'category_name' => 'Automotive Parts Store',
            ],
            [
                'category_name' => 'Automotive Registration Center',
            ],
            [
                'category_name' => 'Automotive Repair Shop',
            ],
            [
                'category_name' => 'Automotive Restoration Service',
            ],
            [
                'category_name' => 'Automotive Service',
            ],
            [
                'category_name' => 'Automotive Shipping Service',
            ],
            [
                'category_name' => 'Automotive Storage Facility',
            ],
            [
                'category_name' => 'Automotive Store',
            ],
            [
                'category_name' => 'Automotive Wheel Polishing Service',
            ],
            [
                'category_name' => 'Automotive Window Tinting Service',
            ],
            [
                'category_name' => 'Aviation Repair Station',
            ],
            [
                'category_name' => 'Aviation School',
            ],
            [
                'category_name' => 'Avionics Shop',
            ],
            [
                'category_name' => 'Awadhi Restaurant',
            ],
            [
                'category_name' => 'Awning Supplier',
            ],
            [
                'category_name' => 'Azerbaijani Restaurant',
            ],
            [
                'category_name' => 'Baby & Children’s Clothing Store',
            ],
            [
                'category_name' => 'Baby Goods/Kids Goods',
            ],
            [
                'category_name' => 'Babysitter',
            ],
            [
                'category_name' => 'Baden Restaurant',
            ],
            [
                'category_name' => 'Badminton Court',
            ],
            [
                'category_name' => 'Bagel Shop',
            ],
            [
                'category_name' => 'Bags & Luggage Company',
            ],
            [
                'category_name' => 'Bags & Luggage Store',
            ],
            [
                'category_name' => 'Bags/Luggage',
            ],
            [
                'category_name' => 'Bail Bondsmen',
            ],
            [
                'category_name' => 'Bakery',
            ],
            [
                'category_name' => 'Balinese Restaurant',
            ],
            [
                'category_name' => 'Balloonport',
            ],
            [
                'category_name' => 'Ballroom',
            ],
            [
                'category_name' => 'Band',
            ],
            [
                'category_name' => 'Bank',
            ],
            [
                'category_name' => 'Bank Equipment & Service',
            ],
            [
                'category_name' => 'Bankruptcy Lawyer',
            ],
            [
                'category_name' => 'Baptist Church',
            ],
            [
                'category_name' => 'Bar',
            ],
            [
                'category_name' => 'Bar & Grill',
            ],
            [
                'category_name' => 'Barbecue Restaurant',
            ],
            [
                'category_name' => 'Barber Shop',
            ],
            [
                'category_name' => 'Bartending School',
            ],
            [
                'category_name' => 'Bartending Service',
            ],
            [
                'category_name' => 'Baseball Field',
            ],
            [
                'category_name' => 'Baseball Stadium',
            ],
            [
                'category_name' => 'Basilicata Restaurant',
            ],
            [
                'category_name' => 'Basketball Court',
            ],
            [
                'category_name' => 'Basketball Stadium',
            ],
            [
                'category_name' => 'Basque Restaurant',
            ],
            [
                'category_name' => 'Batting Cage',
            ],
            [
                'category_name' => 'Bavarian Restaurant',
            ],
            [
                'category_name' => 'Bay',
            ],
            [
                'category_name' => 'Beach',
            ],
            [
                'category_name' => 'Beach Resort',
            ],
            [
                'category_name' => 'Beauty Salon',
            ],
            [
                'category_name' => 'Beauty Store',
            ],
            [
                'category_name' => 'Beauty Supplier',
            ],
            [
                'category_name' => 'Beauty Supply Store',
            ],
            [
                'category_name' => 'Beauty, Cosmetic & Personal Care',
            ],
            [
                'category_name' => 'Bed and Breakfast',
            ],
            [
                'category_name' => 'Beer Bar',
            ],
            [
                'category_name' => 'Beer Garden',
            ],
            [
                'category_name' => 'Beijing Restaurant',
            ],
            [
                'category_name' => 'Belarusian Restaurant',
            ],
            [
                'category_name' => 'Belgian Restaurant',
            ],
            [
                'category_name' => 'Belizean Restaurant',
            ],
            [
                'category_name' => 'Bengali/Bangladeshi Restaurant',
            ],
            [
                'category_name' => 'Betawinese Restaurant',
            ],
            [
                'category_name' => 'Bicycle Repair Service',
            ],
            [
                'category_name' => 'Bicycle Shop',
            ],
            [
                'category_name' => 'Big Box Retailer',
            ],
            [
                'category_name' => 'Bike Rental',
            ],
            [
                'category_name' => 'Bike Trail',
            ],
            [
                'category_name' => 'Biotechnology Company',
            ],
            [
                'category_name' => 'Blinds & Curtains Store',
            ],
            [
                'category_name' => 'Blogger',
            ],
            [
                'category_name' => 'Blood Bank',
            ],
            [
                'category_name' => 'Board Game',
            ],
            [
                'category_name' => 'Boat / Sailing Instructor',
            ],
            [
                'category_name' => 'Boat Rental',
            ],
            [
                'category_name' => 'Boat Service',
            ],
            [
                'category_name' => 'Boat Tour Agency',
            ],
            [
                'category_name' => 'Boat/Ferry Company',
            ],
            [
                'category_name' => 'Bolivian Restaurant',
            ],
            [
                'category_name' => 'Book',
            ],
            [
                'category_name' => 'Book & Magazine Distributor',
            ],
            [
                'category_name' => 'Book Genre',
            ],
            [
                'category_name' => 'Book Series',
            ],
            [
                'category_name' => 'Books & Magazines',
            ],
            [
                'category_name' => 'Bookstore',
            ],
            [
                'category_name' => 'Borough',
            ],
            [
                'category_name' => 'Bossam/Jokbal Restaurant',
            ],
            [
                'category_name' => 'Botanical Garden',
            ],
            [
                'category_name' => 'Bottled Water Company',
            ],
            [
                'category_name' => 'Bottled Water Supplier',
            ],
            [
                'category_name' => 'Boutique Store',
            ],
            [
                'category_name' => 'Bowling Alley',
            ],
            [
                'category_name' => 'Boxing Studio',
            ],
            [
                'category_name' => 'Brand',
            ],
            [
                'category_name' => 'Brand/Company Type',
            ],
            [
                'category_name' => 'Brazilian Restaurant',
            ],
            [
                'category_name' => 'Breakfast & Brunch Restaurant',
            ],
            [
                'category_name' => 'Brewery',
            ],
            [
                'category_name' => 'Bridal Shop',
            ],
            [
                'category_name' => 'Bridge',
            ],
            [
                'category_name' => 'British Restaurant',
            ],
            [
                'category_name' => 'Broadcasting & Media Production Company',
            ],
            [
                'category_name' => 'Brokerage Firm',
            ],
            [
                'category_name' => 'Bubble Tea Shop',
            ],
            [
                'category_name' => 'Buddhist Temple',
            ],
            [
                'category_name' => 'Buffet Restaurant',
            ],
            [
                'category_name' => 'Building Material Store',
            ],
            [
                'category_name' => 'Building Materials',
            ],
            [
                'category_name' => 'Bulgarian Restaurant',
            ],
            [
                'category_name' => 'Bunsik Restaurant',
            ],
            [
                'category_name' => 'Burger Restaurant',
            ],
            [
                'category_name' => 'Burmese Restaurant',
            ],
            [
                'category_name' => 'Bus Line',
            ],
            [
                'category_name' => 'Bus Station',
            ],
            [
                'category_name' => 'Bus Tour Agency',
            ],
            [
                'category_name' => 'Business & Economy Website',
            ],
            [
                'category_name' => 'Business Center',
            ],
            [
                'category_name' => 'Business Consultant',
            ],
            [
                'category_name' => 'Business Service',
            ],
            [
                'category_name' => 'Business Supply Service',
            ],
            [
                'category_name' => 'Butcher Shop',
            ],
            [
                'category_name' => 'Cabin',
            ],
            [
                'category_name' => 'Cabinet & Countertop Store',
            ],
            [
                'category_name' => 'Cable & Satellite Company',
            ],
            [
                'category_name' => 'Cafe',
            ],
            [
                'category_name' => 'Cafeteria',
            ],
            [
                'category_name' => 'Cajun & Creole Restaurant',
            ],
            [
                'category_name' => 'Calabrian Restaurant',
            ],
            [
                'category_name' => 'Cambodian Restaurant',
            ],
            [
                'category_name' => 'Camera Store',
            ],
            [
                'category_name' => 'Camera/Photo',
            ],
            [
                'category_name' => 'Campground',
            ],
            [
                'category_name' => 'Campus Building',
            ],
            [
                'category_name' => 'Canadian Restaurant',
            ],
            [
                'category_name' => 'Canal',
            ],
            [
                'category_name' => 'Candy Store',
            ],
            [
                'category_name' => 'Canoe & Kayak Rental',
            ],
            [
                'category_name' => 'Cantonese Restaurant',
            ],
            [
                'category_name' => 'Cape',
            ],
            [
                'category_name' => 'Car Rental',
            ],
            [
                'category_name' => 'Car Stereo Store',
            ],
            [
                'category_name' => 'Car Wash',
            ],
            [
                'category_name' => 'Cardiologist',
            ],
            [
                'category_name' => 'Career Counselor',
            ],
            [
                'category_name' => 'Cargo & Freight Company',
            ],
            [
                'category_name' => 'Caribbean Restaurant',
            ],
            [
                'category_name' => 'Carnival Supply Store',
            ],
            [
                'category_name' => 'Carpenter',
            ],
            [
                'category_name' => 'Carpet & Flooring Store',
            ],
            [
                'category_name' => 'Carpet Cleaner',
            ],
            [
                'category_name' => 'Cars',
            ],
            [
                'category_name' => 'Cash Advance Service',
            ],
            [
                'category_name' => 'Castle',
            ],
            [
                'category_name' => 'Catalan Restaurant',
            ],
            [
                'category_name' => 'Caterer',
            ],
            [
                'category_name' => 'Catholic Church',
            ],
            [
                'category_name' => 'Cause',
            ],
            [
                'category_name' => 'Cave',
            ],
            [
                'category_name' => 'Cemetery',
            ],
            [
                'category_name' => 'Chaat Place',
            ],
            [
                'category_name' => 'Champagne Bar',
            ],
            [
                'category_name' => 'Charismatic Church',
            ],
            [
                'category_name' => 'Charity Organization',
            ],
            [
                'category_name' => 'Charter Bus Service',
            ],
            [
                'category_name' => 'Cheese Shop',
            ],
            [
                'category_name' => 'Chef',
            ],
            [
                'category_name' => 'Chemical Company',
            ],
            [
                'category_name' => 'Chettinad Restaurant',
            ],
            [
                'category_name' => 'Chicken Joint',
            ],
            [
                'category_name' => 'Child Care Service',
            ],
            [
                'category_name' => 'Child Protective Service',
            ],
            [
                'category_name' => 'Chilean Restaurant',
            ],
            [
                'category_name' => 'Chimney Sweeper',
            ],
            [
                'category_name' => 'Chinese Restaurant',
            ],
            [
                'category_name' => 'Chiropractor',
            ],
            [
                'category_name' => 'Chocolate Shop',
            ],
            [
                'category_name' => 'Choir',
            ],
            [
                'category_name' => 'Christian Church',
            ],
            [
                'category_name' => 'Christian Science Church',
            ],
            [
                'category_name' => 'Church',
            ],
            [
                'category_name' => 'Church of Christ',
            ],
            [
                'category_name' => 'Church of God',
            ],
            [
                'category_name' => 'Church of Jesus Christ of Latter-day Saints',
            ],
            [
                'category_name' => 'City',
            ],
            [
                'category_name' => 'City',
            ],
            [
                'category_name' => 'City Infrastructure',
            ],
            [
                'category_name' => 'Cleaning Service',
            ],
            [
                'category_name' => 'Clothing (Brand)',
            ],
            [
                'category_name' => 'Clothing Company',
            ],
            [
                'category_name' => 'Clothing Store',
            ],
            [
                'category_name' => 'Coach',
            ],
            [
                'category_name' => 'Cocktail Bar',
            ],
            [
                'category_name' => 'Coffee Shop',
            ],
            [
                'category_name' => 'Collectibles Store',
            ],
            [
                'category_name' => 'Collection Agency',
            ],
            [
                'category_name' => 'College & University',
            ],
            [
                'category_name' => 'College / University Bookstore',
            ],
            [
                'category_name' => 'Colombian Restaurant',
            ],
            [
                'category_name' => 'Color',
            ],
            [
                'category_name' => 'Comedian',
            ],
            [
                'category_name' => 'Comfort Food Restaurant',
            ],
            [
                'category_name' => 'Comic Bookstore',
            ],
            [
                'category_name' => 'Commercial & Industrial',
            ],
            [
                'category_name' => 'Commercial & Industrial Equipment Supplier',
            ],
            [
                'category_name' => 'Commercial Bank',
            ],
            [
                'category_name' => 'Commercial Equipment',
            ],
            [
                'category_name' => 'Commercial Real Estate Agency',
            ],
            [
                'category_name' => 'Community',
            ],
            [
                'category_name' => 'Community Center',
            ],
            [
                'category_name' => 'Community College',
            ],
            [
                'category_name' => 'Community Garden',
            ],
            [
                'category_name' => 'Community Organization',
            ],
            [
                'category_name' => 'Community Service',
            ],
            [
                'category_name' => 'Computer Company',
            ],
            [
                'category_name' => 'Computer Repair Service',
            ],
            [
                'category_name' => 'Computer Store',
            ],
            [
                'category_name' => 'Computer Training School',
            ],
            [
                'category_name' => 'Computers & Internet Website',
            ],
            [
                'category_name' => 'Computers (Brand)',
            ],
            [
                'category_name' => 'Concert Tour',
            ],
            [
                'category_name' => 'Concrete Contractor',
            ],
            [
                'category_name' => 'Congregational Church',
            ],
            [
                'category_name' => 'Congressional District',
            ],
            [
                'category_name' => 'Construction Company',
            ],
            [
                'category_name' => 'Consulting Agency',
            ],
            [
                'category_name' => 'Continent',
            ],
            [
                'category_name' => 'Continental Region',
            ],
            [
                'category_name' => 'Continental Restaurant',
            ],
            [
                'category_name' => 'Contract Lawyer',
            ],
            [
                'category_name' => 'Contractor',
            ],
            [
                'category_name' => 'Convenience Store',
            ],
            [
                'category_name' => 'Convent & Monastery',
            ],
            [
                'category_name' => 'Convention Center',
            ],
            [
                'category_name' => 'Cooking School',
            ],
            [
                'category_name' => 'Corporate Lawyer',
            ],
            [
                'category_name' => 'Cosmetic Dentist',
            ],
            [
                'category_name' => 'Cosmetics Store',
            ],
            [
                'category_name' => 'Cosmetology School',
            ],
            [
                'category_name' => 'Costa Rican Restaurant',
            ],
            [
                'category_name' => 'Costume Shop',
            ],
            [
                'category_name' => 'Cottage',
            ],
            [
                'category_name' => 'Counselor',
            ],
            [
                'category_name' => 'Country Club / Clubhouse',
            ],
            [
                'category_name' => 'Country/Region',
            ],
            [
                'category_name' => 'County',
            ],
            [
                'category_name' => 'Course',
            ],
            [
                'category_name' => 'Credit Counseling Service',
            ],
            [
                'category_name' => 'Credit Union',
            ],
            [
                'category_name' => 'Crêperie',
            ],
            [
                'category_name' => 'Cricket Ground',
            ],
            [
                'category_name' => 'Criminal Lawyer',
            ],
            [
                'category_name' => 'Crisis Prevention Center',
            ],
            [
                'category_name' => 'Cruise Agency',
            ],
            [
                'category_name' => 'Cruise Line',
            ],
            [
                'category_name' => 'Cuban Restaurant',
            ],
            [
                'category_name' => 'Cuisine',
            ],
            [
                'category_name' => 'Cultural Center',
            ],
            [
                'category_name' => 'Cultural Gifts Store',
            ],
            [
                'category_name' => 'Cupcake Shop',
            ],
            [
                'category_name' => 'Currency Exchange',
            ],
            [
                'category_name' => 'Cycling Studio',
            ],
            [
                'category_name' => 'Czech Restaurant',
            ],
            [
                'category_name' => 'Damage Restoration Service',
            ],
            [
                'category_name' => 'Dance School',
            ],
            [
                'category_name' => 'Dance Studio',
            ],
            [
                'category_name' => 'Dancer',
            ],
            [
                'category_name' => 'Dating Service',
            ],
            [
                'category_name' => 'Day Care',
            ],
            [
                'category_name' => 'Day Spa',
            ],
            [
                'category_name' => 'Deck & Patio Builder',
            ],
            [
                'category_name' => 'Defense Company',
            ],
            [
                'category_name' => 'Deli',
            ],
            [
                'category_name' => 'Demolition & Excavation Company',
            ],
            [
                'category_name' => 'Dentist & Dental Office',
            ],
            [
                'category_name' => 'Department Store',
            ],
            [
                'category_name' => 'Dermatologist',
            ],
            [
                'category_name' => 'Desert',
            ],
            [
                'category_name' => 'Design & Fashion',
            ],
            [
                'category_name' => 'Designated Market Area',
            ],
            [
                'category_name' => 'Designer',
            ],
            [
                'category_name' => 'Dessert Shop',
            ],
            [
                'category_name' => 'Dhaba Restaurant',
            ],
            [
                'category_name' => 'Diagnostic Center',
            ],
            [
                'category_name' => 'Dialysis Clinic',
            ],
            [
                'category_name' => 'Digital Creator',
            ],
            [
                'category_name' => 'Dim Sum Restaurant',
            ],
            [
                'category_name' => 'Diner',
            ],
            [
                'category_name' => 'Disability Service',
            ],
            [
                'category_name' => 'Disc Golf Course',
            ],
            [
                'category_name' => 'Discount Store',
            ],
            [
                'category_name' => 'Diseases',
            ],
            [
                'category_name' => 'Distillery',
            ],
            [
                'category_name' => 'Dive Bar',
            ],
            [
                'category_name' => 'Diving Spot',
            ],
            [
                'category_name' => 'Divorce & Family Lawyer',
            ],
            [
                'category_name' => 'DJ',
            ],
            [
                'category_name' => 'DMV',
            ],
            [
                'category_name' => 'Doctor',
            ],
            [
                'category_name' => 'Dog Breeder',
            ],
            [
                'category_name' => 'Dog Day Care Center',
            ],
            [
                'category_name' => 'Dog Park',
            ],
            [
                'category_name' => 'Dog Trainer',
            ],
            [
                'category_name' => 'Dog Walker',
            ],
            [
                'category_name' => 'Dominican Restaurant',
            ],
            [
                'category_name' => 'Donburi Restaurant',
            ],
            [
                'category_name' => 'Dongbei Restaurant',
            ],
            [
                'category_name' => 'Donut Shop',
            ],
            [
                'category_name' => 'Dorm',
            ],
            [
                'category_name' => 'Dosa Restaurant',
            ],
            [
                'category_name' => 'Drive In Restaurant',
            ],
            [
                'category_name' => 'Driving Range',
            ],
            [
                'category_name' => 'Driving School',
            ],
            [
                'category_name' => 'Drug Addiction Treatment Center',
            ],
            [
                'category_name' => 'Dry Cleaner',
            ],
            [
                'category_name' => 'DUI Lawyer',
            ],
            [
                'category_name' => 'Duty-Free Shop',
            ],
            [
                'category_name' => 'Eastern European Restaurant',
            ],
            [
                'category_name' => 'Eastern Orthodox Church',
            ],
            [
                'category_name' => 'E-Cigarette Store',
            ],
            [
                'category_name' => 'Eco Tour Agency',
            ],
            [
                'category_name' => 'E-commerce Website',
            ],
            [
                'category_name' => 'Ecuadorian Restaurant',
            ],
            [
                'category_name' => 'Editor',
            ],
            [
                'category_name' => 'Editorial/Opinion',
            ],
            [
                'category_name' => 'Education',
            ],
            [
                'category_name' => 'Education Website',
            ],
            [
                'category_name' => 'Educational Consultant',
            ],
            [
                'category_name' => 'Educational Research Center',
            ],
            [
                'category_name' => 'Educational Supply Store',
            ],
            [
                'category_name' => 'Egyptian Restaurant',
            ],
            [
                'category_name' => 'Election',
            ],
            [
                'category_name' => 'Electric Utility Provider',
            ],
            [
                'category_name' => 'Electrician',
            ],
            [
                'category_name' => 'Electronics',
            ],
            [
                'category_name' => 'Electronics Company',
            ],
            [
                'category_name' => 'Electronics Store',
            ],
            [
                'category_name' => 'Elementary School',
            ],
            [
                'category_name' => 'Elevator Service',
            ],
            [
                'category_name' => 'Emergency Rescue Service',
            ],
            [
                'category_name' => 'Emergency Roadside Service',
            ],
            [
                'category_name' => 'Emergency Room',
            ],
            [
                'category_name' => 'Emilia Romagna Restaurant',
            ],
            [
                'category_name' => 'Employment Agency',
            ],
            [
                'category_name' => 'Endocrinologist',
            ],
            [
                'category_name' => 'Endodontist',
            ],
            [
                'category_name' => 'Energy Company',
            ],
            [
                'category_name' => 'Engineering Service',
            ],
            [
                'category_name' => 'Entertainment Lawyer',
            ],
            [
                'category_name' => 'Entertainment Website',
            ],
            [
                'category_name' => 'Entrepreneur',
            ],
            [
                'category_name' => 'Environmental Conservation Organization',
            ],
            [
                'category_name' => 'Environmental Consultant',
            ],
            [
                'category_name' => 'Environmental Service',
            ],
            [
                'category_name' => 'Episcopal Church',
            ],
            [
                'category_name' => 'Episode',
            ],
            [
                'category_name' => 'Equestrian Center',
            ],
            [
                'category_name' => 'Escrow Service',
            ],
            [
                'category_name' => 'Esports League',
            ],
            [
                'category_name' => 'Esports Team',
            ],
            [
                'category_name' => 'Estate Planning Lawyer',
            ],
            [
                'category_name' => 'Ethiopian Restaurant',
            ],
            [
                'category_name' => 'Ethnic Grocery Store',
            ],
            [
                'category_name' => 'European Restaurant',
            ],
            [
                'category_name' => 'Evangelical Church',
            ],
            [
                'category_name' => 'Event',
            ],
            [
                'category_name' => 'Event Photographer',
            ],
            [
                'category_name' => 'Event Planner',
            ],
            [
                'category_name' => 'Event Space',
            ],
            [
                'category_name' => 'Event Videographer',
            ],
            [
                'category_name' => 'Exchange Program',
            ],
            [
                'category_name' => 'Exotic Car Rental',
            ],
            [
                'category_name' => 'Fabric Store',
            ],
            [
                'category_name' => 'Fairground',
            ],
            [
                'category_name' => 'Family Doctor',
            ],
            [
                'category_name' => 'Family Medicine Practice',
            ],
            [
                'category_name' => 'Family Style Restaurant',
            ],
            [
                'category_name' => 'Family Therapist',
            ],
            [
                'category_name' => 'Fan Page',
            ],
            [
                'category_name' => 'Farmers Market',
            ],
            [
                'category_name' => 'Fashion Designer',
            ],
            [
                'category_name' => 'Fashion Model',
            ],
            [
                'category_name' => 'Fast Food Restaurant',
            ],
            [
                'category_name' => 'Fence & Gate Contractor',
            ],
            [
                'category_name' => 'Fencing Club',
            ],
            [
                'category_name' => 'Fertility Doctor',
            ],
            [
                'category_name' => 'Festival',
            ],
            [
                'category_name' => 'Field',
            ],
            [
                'category_name' => 'Filipino Restaurant',
            ],
            [
                'category_name' => 'Film Director',
            ],
            [
                'category_name' => 'Finance',
            ],
            [
                'category_name' => 'Financial Aid Service',
            ],
            [
                'category_name' => 'Financial Consultant',
            ],
            [
                'category_name' => 'Financial Planner',
            ],
            [
                'category_name' => 'Financial Service',
            ],
            [
                'category_name' => 'Fire Protection Service',
            ],
            [
                'category_name' => 'Fireplace Store',
            ],
            [
                'category_name' => 'Fireworks Retailer',
            ],
            [
                'category_name' => 'First Aid Class',
            ],
            [
                'category_name' => 'Fish & Chips Restaurant',
            ],
            [
                'category_name' => 'Fish Market',
            ],
            [
                'category_name' => 'Fishing Charter',
            ],
            [
                'category_name' => 'Fishing Spot',
            ],
            [
                'category_name' => 'Fishing Store',
            ],
            [
                'category_name' => 'Fitness Boot Camp',
            ],
            [
                'category_name' => 'Fitness Model',
            ],
            [
                'category_name' => 'Fitness Trainer',
            ],
            [
                'category_name' => 'Fitness Venue',
            ],
            [
                'category_name' => 'Fjord/Loch',
            ],
            [
                'category_name' => 'Flea Market',
            ],
            [
                'category_name' => 'Flight School',
            ],
            [
                'category_name' => 'Florist',
            ],
            [
                'category_name' => 'Flyboarding Center',
            ],
            [
                'category_name' => 'Fondue Restaurant',
            ],
            [
                'category_name' => 'Food & Beverage',
            ],
            [
                'category_name' => 'Food Bank',
            ],
            [
                'category_name' => 'Food Consultant',
            ],
            [
                'category_name' => 'Food Delivery Service',
            ],
            [
                'category_name' => 'Food Stand',
            ],
            [
                'category_name' => 'Food Tour Agency',
            ],
            [
                'category_name' => 'Food Truck',
            ],
            [
                'category_name' => 'Food Website',
            ],
            [
                'category_name' => 'Food Wholesaler',
            ],
            [
                'category_name' => 'Foodservice Distributor',
            ],
            [
                'category_name' => 'Football Stadium',
            ],
            [
                'category_name' => 'Footwear Store',
            ],
            [
                'category_name' => 'Forestry & Logging',
            ],
            [
                'category_name' => 'Forestry Service',
            ],
            [
                'category_name' => 'Fort',
            ],
            [
                'category_name' => 'Franchise Broker',
            ],
            [
                'category_name' => 'Franchising Service',
            ],
            [
                'category_name' => 'French Restaurant',
            ],
            [
                'category_name' => 'Friuli Venezia Giulia Restaurant',
            ],
            [
                'category_name' => 'Frozen Yogurt Shop',
            ],
            [
                'category_name' => 'Fruit & Vegetable Store',
            ],
            [
                'category_name' => 'Fujian Restaurant',
            ],
            [
                'category_name' => 'Full Gospel Church',
            ],
            [
                'category_name' => 'Funeral Service & Cemetery',
            ],
            [
                'category_name' => 'Furniture',
            ],
            [
                'category_name' => 'Furniture Repair & Upholstery Service',
            ],
            [
                'category_name' => 'Furniture Store',
            ],
            [
                'category_name' => 'Game Publisher',
            ],
            [
                'category_name' => 'Gamer',
            ],
            [
                'category_name' => 'Games/Toys',
            ],
            [
                'category_name' => 'Gaming Video Creator',
            ],
            [
                'category_name' => 'Garage Door Service',
            ],
            [
                'category_name' => 'Garden Center',
            ],
            [
                'category_name' => 'Gardener',
            ],
            [
                'category_name' => 'Gas & Chemical Service',
            ],
            [
                'category_name' => 'Gas Station',
            ],
            [
                'category_name' => 'Gastroenterologist',
            ],
            [
                'category_name' => 'Gastropub',
            ],
            [
                'category_name' => 'Gay Bar',
            ],
            [
                'category_name' => 'Gelato Shop',
            ],
            [
                'category_name' => 'Genealogist',
            ],
            [
                'category_name' => 'General Dentist',
            ],
            [
                'category_name' => 'General Litigation',
            ],
            [
                'category_name' => 'Geo Entity',
            ],
            [
                'category_name' => 'Geographical Place',
            ],
            [
                'category_name' => 'Geologic Service',
            ],
            [
                'category_name' => 'Georgian Restaurant',
            ],
            [
                'category_name' => 'German Restaurant',
            ],
            [
                'category_name' => 'Gerontologist',
            ],
            [
                'category_name' => 'Gift Shop',
            ],
            [
                'category_name' => 'Glacier',
            ],
            [
                'category_name' => 'Glass & Mirror Shop',
            ],
            [
                'category_name' => 'Glass Blower',
            ],
            [
                'category_name' => 'Glass Manufacturer',
            ],
            [
                'category_name' => 'Glass Service',
            ],
            [
                'category_name' => 'Gluten-Free Restaurant',
            ],
            [
                'category_name' => 'Goan Restaurant',
            ],
            [
                'category_name' => 'Go-Kart Track',
            ],
            [
                'category_name' => 'Golf Course & Country Club',
            ],
            [
                'category_name' => 'Golf Instructor',
            ],
            [
                'category_name' => 'Granite & Marble Supplier',
            ],
            [
                'category_name' => 'Graphic Designer',
            ],
            [
                'category_name' => 'Greek Restaurant',
            ],
            [
                'category_name' => 'Grocery Store',
            ],
            [
                'category_name' => 'Guatemalan Restaurant',
            ],
            [
                'category_name' => 'Guizhou Restaurant',
            ],
            [
                'category_name' => 'Gujarati Restaurant',
            ],
            [
                'category_name' => 'Gukbap Restaurant',
            ],
            [
                'category_name' => 'Gun Range',
            ],
            [
                'category_name' => 'Gun Store',
            ],
            [
                'category_name' => 'Gutter Cleaning Service',
            ],
            [
                'category_name' => 'Gym',
            ],
            [
                'category_name' => 'Gymnastics Center',
            ],
            [
                'category_name' => 'Hainan Restaurant',
            ],
            [
                'category_name' => 'Hair Extensions Service',
            ],
            [
                'category_name' => 'Hair Removal Service',
            ],
            [
                'category_name' => 'Hair Replacement Service',
            ],
            [
                'category_name' => 'Hair Salon',
            ],
            [
                'category_name' => 'Haitian Restaurant',
            ],
            [
                'category_name' => 'Halal Restaurant',
            ],
            [
                'category_name' => 'Halfway House',
            ],
            [
                'category_name' => 'Handyman',
            ],
            [
                'category_name' => 'Hang Gliding Center',
            ],
            [
                'category_name' => 'Harbor',
            ],
            [
                'category_name' => 'Hardware Store',
            ],
            [
                'category_name' => 'Harmonized Page',
            ],
            [
                'category_name' => 'Hat Store',
            ],
            [
                'category_name' => 'Hawaiian Restaurant',
            ],
            [
                'category_name' => 'Health & Wellness Website',
            ],
            [
                'category_name' => 'Health Food Restaurant',
            ],
            [
                'category_name' => 'Health Food Store',
            ],
            [
                'category_name' => 'Health Spa',
            ],
            [
                'category_name' => 'Health/Beauty',
            ],
            [
                'category_name' => 'Healthcare Administrator',
            ],
            [
                'category_name' => 'Heating, Ventilating & Air Conditioning Service',
            ],
            [
                'category_name' => 'Hedge Fund',
            ],
            [
                'category_name' => 'Heliport',
            ],
            [
                'category_name' => 'Henan Restaurant',
            ],
            [
                'category_name' => 'Hessian Restaurant',
            ],
            [
                'category_name' => 'High School',
            ],
            [
                'category_name' => 'Highway',
            ],
            [
                'category_name' => 'Hiking Trail',
            ],
            [
                'category_name' => 'Himalayan Restaurant',
            ],
            [
                'category_name' => 'Hindu Temple',
            ],
            [
                'category_name' => 'Historical Tour Agency',
            ],
            [
                'category_name' => 'Hobby Store',
            ],
            [
                'category_name' => 'Hockey Arena',
            ],
            [
                'category_name' => 'Hockey Field / Rink',
            ],
            [
                'category_name' => 'Holiness Church',
            ],
            [
                'category_name' => 'Home',
            ],
            [
                'category_name' => 'Home & Garden Store',
            ],
            [
                'category_name' => 'Home & Garden Website',
            ],
            [
                'category_name' => 'Home Decor',
            ],
            [
                'category_name' => 'Home Goods Store',
            ],
            [
                'category_name' => 'Home Health Care Service',
            ],
            [
                'category_name' => 'Home Improvement',
            ],
            [
                'category_name' => 'Home Inspector',
            ],
            [
                'category_name' => 'Home Mover',
            ],
            [
                'category_name' => 'Home Security Company',
            ],
            [
                'category_name' => 'Home Staging Service',
            ],
            [
                'category_name' => 'Home Theater Store',
            ],
            [
                'category_name' => 'Home Window Service',
            ],
            [
                'category_name' => 'Homebrew Supply Store',
            ],
            [
                'category_name' => 'Honduran Restaurant',
            ],
            [
                'category_name' => 'Hong Kong Restaurant',
            ],
            [
                'category_name' => 'Hookah Lounge',
            ],
            [
                'category_name' => 'Horse Riding School',
            ],
            [
                'category_name' => 'Horse Trainer',
            ],
            [
                'category_name' => 'Horseback Riding Center',
            ],
            [
                'category_name' => 'Horse-Drawn Carriage Service',
            ],
            [
                'category_name' => 'Hospice',
            ],
            [
                'category_name' => 'Hospital',
            ],
            [
                'category_name' => 'Hospitality Service',
            ],
            [
                'category_name' => 'Hostel',
            ],
            [
                'category_name' => 'Hot Air Balloon Tour Agency',
            ],
            [
                'category_name' => 'Hot Dog Joint',
            ],
            [
                'category_name' => 'Hot Pot Restaurant',
            ],
            [
                'category_name' => 'Hot Spring',
            ],
            [
                'category_name' => 'Hotel',
            ],
            [
                'category_name' => 'Hotel & Lodging',
            ],
            [
                'category_name' => 'Hotel Bar',
            ],
            [
                'category_name' => 'Hotel Resort',
            ],
            [
                'category_name' => 'Hotel Services Company',
            ],
            [
                'category_name' => 'House Painting',
            ],
            [
                'category_name' => 'House Sitter',
            ],
            [
                'category_name' => 'Household Supplies',
            ],
            [
                'category_name' => 'Housing & Homeless Shelter',
            ],
            [
                'category_name' => 'Housing Assistance Service',
            ],
            [
                'category_name' => 'Huaiyang Restaurant',
            ],
            [
                'category_name' => 'Hubei Restaurant',
            ],
            [
                'category_name' => 'Hunan Restaurant',
            ],
            [
                'category_name' => 'Hungarian Restaurant',
            ],
            [
                'category_name' => 'Hyderabadi Restaurant',
            ],
            [
                'category_name' => 'Iberian Restaurant',
            ],
            [
                'category_name' => 'Ice Cream Shop',
            ],
            [
                'category_name' => 'Ice Skating Rink',
            ],
            [
                'category_name' => 'Image Consultant',
            ],
            [
                'category_name' => 'Immigration Lawyer',
            ],
            [
                'category_name' => 'Imperial Restaurant',
            ],
            [
                'category_name' => 'Independent Bookstore',
            ],
            [
                'category_name' => 'Independent Church',
            ],
            [
                'category_name' => 'Indian Chinese Restaurant',
            ],
            [
                'category_name' => 'Indian Restaurant',
            ],
            [
                'category_name' => 'Indo Chinese Restaurant',
            ],
            [
                'category_name' => 'Indonesian Restaurant',
            ],
            [
                'category_name' => 'Industrial Company',
            ],
            [
                'category_name' => 'Information Technology Company',
            ],
            [
                'category_name' => 'In-Home Service',
            ],
            [
                'category_name' => 'Inn',
            ],
            [
                'category_name' => 'Insurance Agent',
            ],
            [
                'category_name' => 'Insurance Broker',
            ],
            [
                'category_name' => 'Insurance Company',
            ],
            [
                'category_name' => 'Intellectual Property Lawyer',
            ],
            [
                'category_name' => 'Interdenominational Church',
            ],
            [
                'category_name' => 'Interest',
            ],
            [
                'category_name' => 'Intergovernmental Organization',
            ],
            [
                'category_name' => 'Interior Design Studio',
            ],
            [
                'category_name' => 'Internet Cafe',
            ],
            [
                'category_name' => 'Internet Company',
            ],
            [
                'category_name' => 'Internet Lawyer',
            ],
            [
                'category_name' => 'Internet Service Provider',
            ],
            [
                'category_name' => 'Internist (Internal Medicine)',
            ],
            [
                'category_name' => 'Inventory Control Service',
            ],
            [
                'category_name' => 'Investing Service',
            ],
            [
                'category_name' => 'Investment Bank',
            ],
            [
                'category_name' => 'Investment Management Company',
            ],
            [
                'category_name' => 'Irani Restaurant',
            ],
            [
                'category_name' => 'Irish Pub',
            ],
            [
                'category_name' => 'Irish Restaurant',
            ],
            [
                'category_name' => 'Island',
            ],
            [
                'category_name' => 'Israeli Restaurant',
            ],
            [
                'category_name' => 'Italian Restaurant',
            ],
            [
                'category_name' => 'Jain Restaurant',
            ],
            [
                'category_name' => 'Jamaican Restaurant',
            ],
            [
                'category_name' => 'Janguh Restaurant',
            ],
            [
                'category_name' => 'Janitorial Service',
            ],
            [
                'category_name' => 'Japanese Restaurant',
            ],
            [
                'category_name' => 'Javanese Restaurant',
            ],
            [
                'category_name' => 'Jet Ski Rental',
            ],
            [
                'category_name' => 'Jewelry & Watches Company',
            ],
            [
                'category_name' => 'Jewelry & Watches Store',
            ],
            [
                'category_name' => 'Jewelry Wholesaler',
            ],
            [
                'category_name' => 'Jewelry/Watches',
            ],
            [
                'category_name' => 'Jiangsu Restaurant',
            ],
            [
                'category_name' => 'Jiangxi Restaurant',
            ],
            [
                'category_name' => 'Journalist',
            ],
            [
                'category_name' => 'Junior High School',
            ],
            [
                'category_name' => 'Junkyard',
            ],
            [
                'category_name' => 'Just For Fun',
            ],
            [
                'category_name' => 'Juvenile Lawyer',
            ],
            [
                'category_name' => 'Kaiseki Restaurant',
            ],
            [
                'category_name' => 'Karnataka Restaurant',
            ],
            [
                'category_name' => 'Kashmiri Restaurant',
            ],
            [
                'category_name' => 'Kebab Shop',
            ],
            [
                'category_name' => 'Kennel',
            ],
            [
                'category_name' => 'Kerala Restaurant',
            ],
            [
                'category_name' => 'Kids Entertainment Service',
            ],
            [
                'category_name' => 'Kingdom Hall',
            ],
            [
                'category_name' => 'Kitchen & Bath Contractor',
            ],
            [
                'category_name' => 'Kitchen/Cooking',
            ],
            [
                'category_name' => 'Kiteboarding Center',
            ],
            [
                'category_name' => 'Korean Restaurant',
            ],
            [
                'category_name' => 'Kosher Restaurant',
            ],
            [
                'category_name' => 'Kurdish Restaurant',
            ],
            [
                'category_name' => 'Kushikatsu Restaurant',
            ],
            [
                'category_name' => 'Labor & Employment Lawyer',
            ],
            [
                'category_name' => 'Labor Union',
            ],
            [
                'category_name' => 'Lake',
            ],
            [
                'category_name' => 'Landlord & Tenant Lawyer',
            ],
            [
                'category_name' => 'Landmark & Historical Place',
            ],
            [
                'category_name' => 'Landscape Company',
            ],
            [
                'category_name' => 'Language',
            ],
            [
                'category_name' => 'Language School',
            ],
            [
                'category_name' => 'Large Geo Area',
            ],
            [
                'category_name' => 'Laser Hair Removal Service',
            ],
            [
                'category_name' => 'Laser Tag Center',
            ],
            [
                'category_name' => 'Lasik/Laser Eye Surgeon',
            ],
            [
                'category_name' => 'Latin American Restaurant',
            ],
            [
                'category_name' => 'Laundromat',
            ],
            [
                'category_name' => 'Law Enforcement Agency',
            ],
            [
                'category_name' => 'Lawyer & Law Firm',
            ],
            [
                'category_name' => 'Lebanese Restaurant',
            ],
            [
                'category_name' => 'Legal',
            ],
            [
                'category_name' => 'Legal Service',
            ],
            [
                'category_name' => 'Library',
            ],
            [
                'category_name' => 'Light Rail Station',
            ],
            [
                'category_name' => 'Lighthouse',
            ],
            [
                'category_name' => 'Lighting Store',
            ],
            [
                'category_name' => 'Ligurian Restaurant',
            ],
            [
                'category_name' => 'Limo Service',
            ],
            [
                'category_name' => 'Lingerie & Underwear Store',
            ],
            [
                'category_name' => 'Literary Arts',
            ],
            [
                'category_name' => 'Live & Raw Food Restaurant',
            ],
            [
                'category_name' => 'Livery Stable',
            ],
            [
                'category_name' => 'Loan Service',
            ],
            [
                'category_name' => 'Lobbyist',
            ],
            [
                'category_name' => 'Local & Travel Website',
            ],
            [
                'category_name' => 'Local Service',
            ],
            [
                'category_name' => 'Locality',
            ],
            [
                'category_name' => 'Locksmith',
            ],
            [
                'category_name' => 'Lodge',
            ],
            [
                'category_name' => 'Logging Contractor',
            ],
            [
                'category_name' => 'Lombard Restaurant',
            ],
            [
                'category_name' => 'Lottery Retailer',
            ],
            [
                'category_name' => 'Lounge',
            ],
            [
                'category_name' => 'Luggage Service',
            ],
            [
                'category_name' => 'Lumber Yard',
            ],
            [
                'category_name' => 'Lutheran Church',
            ],
            [
                'category_name' => 'Macanese Restaurant',
            ],
            [
                'category_name' => 'Machine Shop',
            ],
            [
                'category_name' => 'Magazine',
            ],
            [
                'category_name' => 'Magician',
            ],
            [
                'category_name' => 'Maharashtrian Restaurant',
            ],
            [
                'category_name' => 'Maid & Butler',
            ],
            [
                'category_name' => 'Makeup Artist',
            ],
            [
                'category_name' => 'Malaysian Restaurant',
            ],
            [
                'category_name' => 'Malpractice Lawyer',
            ],
            [
                'category_name' => 'Manadonese Restaurant',
            ],
            [
                'category_name' => 'Management Service',
            ],
            [
                'category_name' => 'Manchu Restaurant',
            ],
            [
                'category_name' => 'Manufacturer/Supplier',
            ],
            [
                'category_name' => 'Marche Restaurant',
            ],
            [
                'category_name' => 'Marina',
            ],
            [
                'category_name' => 'Marine Service Station',
            ],
            [
                'category_name' => 'Marine Supply Store',
            ],
            [
                'category_name' => 'Marriage Therapist',
            ],
            [
                'category_name' => 'Martial Arts School',
            ],
            [
                'category_name' => 'Masonry Contractor',
            ],
            [
                'category_name' => 'Massage School',
            ],
            [
                'category_name' => 'Massage Service',
            ],
            [
                'category_name' => 'Massage Therapist',
            ],
            [
                'category_name' => 'Maternity & Nursing Clothing Store',
            ],
            [
                'category_name' => 'Maternity Clinic',
            ],
            [
                'category_name' => 'Mattress Manufacturer',
            ],
            [
                'category_name' => 'Mattress Store',
            ],
            [
                'category_name' => 'Mattress Wholesaler',
            ],
            [
                'category_name' => 'Meat Wholesaler',
            ],
            [
                'category_name' => 'Media',
            ],
            [
                'category_name' => 'Media Restoration Service',
            ],
            [
                'category_name' => 'Media/News Company',
            ],
            [
                'category_name' => 'Medical & Health',
            ],
            [
                'category_name' => 'Medical Cannabis Dispensary',
            ],
            [
                'category_name' => 'Medical Center',
            ],
            [
                'category_name' => 'Medical Device Company',
            ],
            [
                'category_name' => 'Medical Equipment Manufacturer',
            ],
            [
                'category_name' => 'Medical Equipment Supplier',
            ],
            [
                'category_name' => 'Medical Lab',
            ],
            [
                'category_name' => 'Medical Lawyer',
            ],
            [
                'category_name' => 'Medical Research Center',
            ],
            [
                'category_name' => 'Medical School',
            ],
            [
                'category_name' => 'Medical Service',
            ],
            [
                'category_name' => 'Medical Spa',
            ],
            [
                'category_name' => 'Medical Supply Store',
            ],
            [
                'category_name' => 'Meditation Center',
            ],
            [
                'category_name' => 'Mediterranean Restaurant',
            ],
            [
                'category_name' => 'Medium Geo Area',
            ],
            [
                'category_name' => 'Meeting Room',
            ],
            [
                'category_name' => 'Mennonite Church',
            ],
            [
                'category_name' => 'Men’s Clothing Store',
            ],
            [
                'category_name' => 'Mental Health Service',
            ],
            [
                'category_name' => 'Metal & Steel Company',
            ],
            [
                'category_name' => 'Metal Fabricator',
            ],
            [
                'category_name' => 'Metal Plating Service Company',
            ],
            [
                'category_name' => 'Metal Supplier',
            ],
            [
                'category_name' => 'Methodist Church',
            ],
            [
                'category_name' => 'Metro Area',
            ],
            [
                'category_name' => 'Mexican Restaurant',
            ],
            [
                'category_name' => 'Middle Eastern Restaurant',
            ],
            [
                'category_name' => 'Middle School',
            ],
            [
                'category_name' => 'Military Lawyer',
            ],
            [
                'category_name' => 'Miniature Golf Course',
            ],
            [
                'category_name' => 'Mining Company',
            ],
            [
                'category_name' => 'Mission',
            ],
            [
                'category_name' => 'Mobile Home Dealer',
            ],
            [
                'category_name' => 'Mobile Home Park',
            ],
            [
                'category_name' => 'Mobile Phone Shop',
            ],
            [
                'category_name' => 'Modeling Agency',
            ],
            [
                'category_name' => 'Modern European Restaurant',
            ],
            [
                'category_name' => 'Molecular Gastronomy Restaurant',
            ],
            [
                'category_name' => 'Molise Restaurant',
            ],
            [
                'category_name' => 'Mongolian Restaurant',
            ],
            [
                'category_name' => 'Monjayaki Restaurant',
            ],
            [
                'category_name' => 'Monument',
            ],
            [
                'category_name' => 'Mood',
            ],
            [
                'category_name' => 'Moroccan Restaurant',
            ],
            [
                'category_name' => 'Mortgage Brokers',
            ],
            [
                'category_name' => 'Mosque',
            ],
            [
                'category_name' => 'Motel',
            ],
            [
                'category_name' => 'Motivational Speaker',
            ],
            [
                'category_name' => 'Motor Vehicle Company',
            ],
            [
                'category_name' => 'Motorcycle Manufacturer',
            ],
            [
                'category_name' => 'Motorcycle Repair Shop',
            ],
            [
                'category_name' => 'Motorsports Store',
            ],
            [
                'category_name' => 'Mountain',
            ],
            [
                'category_name' => 'Mountain Biking Shop',
            ],
            [
                'category_name' => 'Movie',
            ],
            [
                'category_name' => 'Movie & Music Store',
            ],
            [
                'category_name' => 'Movie Character',
            ],
            [
                'category_name' => 'Movie Genre',
            ],
            [
                'category_name' => 'Movie/Television Studio',
            ],
            [
                'category_name' => 'Moving & Storage Service',
            ],
            [
                'category_name' => 'Moving Supply Store',
            ],
            [
                'category_name' => 'Mughalai Restaurant',
            ],
            [
                'category_name' => 'Music',
            ],
            [
                'category_name' => 'Music Award',
            ],
            [
                'category_name' => 'Music Chart',
            ],
            [
                'category_name' => 'Music Lessons & Instruction School',
            ],
            [
                'category_name' => 'Music Production Studio',
            ],
            [
                'category_name' => 'Music Video',
            ],
            [
                'category_name' => 'Musical Genre',
            ],
            [
                'category_name' => 'Musical Instrument',
            ],
            [
                'category_name' => 'Musical Instrument Store',
            ],
            [
                'category_name' => 'Musician',
            ],
            [
                'category_name' => 'Musician/Band',
            ],
            [
                'category_name' => 'Nabe Restaurant',
            ],
            [
                'category_name' => 'Nail Salon',
            ],
            [
                'category_name' => 'Nanny',
            ],
            [
                'category_name' => 'National Forest',
            ],
            [
                'category_name' => 'National Park',
            ],
            [
                'category_name' => 'Nationality',
            ],
            [
                'category_name' => 'Nature Preserve',
            ],
            [
                'category_name' => 'Naturopath',
            ],
            [
                'category_name' => 'Nazarene Church',
            ],
            [
                'category_name' => 'Neapolitan Restaurant',
            ],
            [
                'category_name' => 'Neighborhood',
            ],
            [
                'category_name' => 'Nepalese Restaurant',
            ],
            [
                'category_name' => 'Nephrologist',
            ],
            [
                'category_name' => 'Neurologist',
            ],
            [
                'category_name' => 'Neurosurgeon',
            ],
            [
                'category_name' => 'New American Restaurant',
            ],
            [
                'category_name' => 'News & Media Website',
            ],
            [
                'category_name' => 'News Personality',
            ],
            [
                'category_name' => 'Newspaper',
            ],
            [
                'category_name' => 'Newsstand',
            ],
            [
                'category_name' => 'Nicaraguan Restaurant',
            ],
            [
                'category_name' => 'Nigerian Restaurant',
            ],
            [
                'category_name' => 'Night Market',
            ],
            [
                'category_name' => 'Non-Business Places',
            ],
            [
                'category_name' => 'Nondenominational Church',
            ],
            [
                'category_name' => 'Non-Governmental Organization (NGO)',
            ],
            [
                'category_name' => 'Nonprofit Organization',
            ],
            [
                'category_name' => 'Noodle House',
            ],
            [
                'category_name' => 'North Indian Restaurant',
            ],
            [
                'category_name' => 'Not a Business',
            ],
            [
                'category_name' => 'Notary Public',
            ],
            [
                'category_name' => 'Nurseries & Gardening Store',
            ],
            [
                'category_name' => 'Nursing Agency',
            ],
            [
                'category_name' => 'Nursing Home',
            ],
            [
                'category_name' => 'Nursing School',
            ],
            [
                'category_name' => 'Nutritionist',
            ],
            [
                'category_name' => 'Obstetrician-Gynecologist (OBGYN)',
            ],
            [
                'category_name' => 'Occupational Safety and Health Service',
            ],
            [
                'category_name' => 'Occupational Therapist',
            ],
            [
                'category_name' => 'Ocean',
            ],
            [
                'category_name' => 'Office Equipment Store',
            ],
            [
                'category_name' => 'Office Supplies',
            ],
            [
                'category_name' => 'Oil Lube & Filter Service',
            ],
            [
                'category_name' => 'Okonomiyaki Restaurant',
            ],
            [
                'category_name' => 'Oncologist',
            ],
            [
                'category_name' => 'One-Time TV Program',
            ],
            [
                'category_name' => 'Onsen',
            ],
            [
                'category_name' => 'Ophthalmologist',
            ],
            [
                'category_name' => 'Optician',
            ],
            [
                'category_name' => 'Optometrist',
            ],
            [
                'category_name' => 'Oral Surgeon',
            ],
            [
                'category_name' => 'Orchestra',
            ],
            [
                'category_name' => 'Organic Grocery Store',
            ],
            [
                'category_name' => 'Orthodontist',
            ],
            [
                'category_name' => 'Orthopedist',
            ],
            [
                'category_name' => 'Orthotics & Prosthetics Service',
            ],
            [
                'category_name' => 'Osteopathic Doctor',
            ],
            [
                'category_name' => 'Other',
            ],
            [
                'category_name' => 'Otolaryngologist (ENT)',
            ],
            [
                'category_name' => 'Outdoor & Sporting Goods Company',
            ],
            [
                'category_name' => 'Outdoor Equipment Store',
            ],
            [
                'category_name' => 'Outdoor Recreation',
            ],
            [
                'category_name' => 'Outlet Store',
            ],
            [
                'category_name' => 'Padangnese Restaurant',
            ],
            [
                'category_name' => 'Paddleboarding Center',
            ],
            [
                'category_name' => 'Paintball Center',
            ],
            [
                'category_name' => 'Painting Lessons',
            ],
            [
                'category_name' => 'Pakistani Restaurant',
            ],
            [
                'category_name' => 'Palace',
            ],
            [
                'category_name' => 'Palatine Restaurant',
            ],
            [
                'category_name' => 'Panamanian Restaurant',
            ],
            [
                'category_name' => 'Paraguayan Restaurant',
            ],
            [
                'category_name' => 'Park',
            ],
            [
                'category_name' => 'Parking Garage / Lot',
            ],
            [
                'category_name' => 'Parsi Restaurant',
            ],
            [
                'category_name' => 'Party & Entertainment Service',
            ],
            [
                'category_name' => 'Party Entertainment Service',
            ],
            [
                'category_name' => 'Party Supply & Rental Shop',
            ],
            [
                'category_name' => 'Passport & Visa Service',
            ],
            [
                'category_name' => 'Patio/Garden',
            ],
            [
                'category_name' => 'Paving & Asphalt Service',
            ],
            [
                'category_name' => 'Pawn Shop',
            ],
            [
                'category_name' => 'Pediatric Dentist',
            ],
            [
                'category_name' => 'Pediatrician',
            ],
            [
                'category_name' => 'Pedicab Service',
            ],
            [
                'category_name' => 'Pentecostal Church',
            ],
            [
                'category_name' => 'Performance Art',
            ],
            [
                'category_name' => 'Performing Arts',
            ],
            [
                'category_name' => 'Performing Arts School',
            ],
            [
                'category_name' => 'Periodontist',
            ],
            [
                'category_name' => 'Persian/Iranian Restaurant',
            ],
            [
                'category_name' => 'Personal Assistant',
            ],
            [
                'category_name' => 'Personal Blog',
            ],
            [
                'category_name' => 'Personal Chef',
            ],
            [
                'category_name' => 'Personal Coach',
            ],
            [
                'category_name' => 'Personal Injury Lawyer',
            ],
            [
                'category_name' => 'Peruvian Restaurant',
            ],
            [
                'category_name' => 'Pest Control Service',
            ],
            [
                'category_name' => 'Pet Adoption Service',
            ],
            [
                'category_name' => 'Pet Breeder',
            ],
            [
                'category_name' => 'Pet Cafe',
            ],
            [
                'category_name' => 'Pet Cemetery',
            ],
            [
                'category_name' => 'Pet Groomer',
            ],
            [
                'category_name' => 'Pet Service',
            ],
            [
                'category_name' => 'Pet Sitter',
            ],
            [
                'category_name' => 'Pet Store',
            ],
            [
                'category_name' => 'Pet Supplies',
            ],
            [
                'category_name' => 'Petroleum Service',
            ],
            [
                'category_name' => 'Pharmaceutical Company',
            ],
            [
                'category_name' => 'Pharmaceuticals',
            ],
            [
                'category_name' => 'Pharmacy / Drugstore',
            ],
            [
                'category_name' => 'Pho Restaurant',
            ],
            [
                'category_name' => 'Phone/Tablet',
            ],
            [
                'category_name' => 'Photo Booth Service',
            ],
            [
                'category_name' => 'Photographer',
            ],
            [
                'category_name' => 'Photography Videography',
            ],
            [
                'category_name' => 'Physical Fitness Center',
            ],
            [
                'category_name' => 'Physical Therapist',
            ],
            [
                'category_name' => 'Picnic Ground',
            ],
            [
                'category_name' => 'Piedmont Restaurant',
            ],
            [
                'category_name' => 'Pier',
            ],
            [
                'category_name' => 'Pilates Studio',
            ],
            [
                'category_name' => 'Pizza Place',
            ],
            [
                'category_name' => 'Plastic Company',
            ],
            [
                'category_name' => 'Plastic Fabricator',
            ],
            [
                'category_name' => 'Plastic Manufacturer',
            ],
            [
                'category_name' => 'Plastic Surgeon',
            ],
            [
                'category_name' => 'Playground',
            ],
            [
                'category_name' => 'Playlist',
            ],
            [
                'category_name' => 'Plumbing Service',
            ],
            [
                'category_name' => 'Podcast',
            ],
            [
                'category_name' => 'Podiatrist',
            ],
            [
                'category_name' => 'Poke Restaurant',
            ],
            [
                'category_name' => 'Polish Restaurant',
            ],
            [
                'category_name' => 'Polynesian Restaurant',
            ],
            [
                'category_name' => 'Pond',
            ],
            [
                'category_name' => 'Pop-Up Shop',
            ],
            [
                'category_name' => 'Port',
            ],
            [
                'category_name' => 'Portable Building Service',
            ],
            [
                'category_name' => 'Portable Toilet Rentals',
            ],
            [
                'category_name' => 'Portuguese Restaurant',
            ],
            [
                'category_name' => 'Postal Code',
            ],
            [
                'category_name' => 'Powder Coating Service',
            ],
            [
                'category_name' => 'Pregnancy Care Center',
            ],
            [
                'category_name' => 'Presbyterian Church',
            ],
            [
                'category_name' => 'Preschool',
            ],
            [
                'category_name' => 'Printing Service',
            ],
            [
                'category_name' => 'Private Investigator',
            ],
            [
                'category_name' => 'Private Members Club',
            ],
            [
                'category_name' => 'Private Plane Charter',
            ],
            [
                'category_name' => 'Private School',
            ],
            [
                'category_name' => 'Process Service',
            ],
            [
                'category_name' => 'Proctologist',
            ],
            [
                'category_name' => 'Producer',
            ],
            [
                'category_name' => 'Product Type',
            ],
            [
                'category_name' => 'Product/Service',
            ],
            [
                'category_name' => 'Professional Sports League',
            ],
            [
                'category_name' => 'Professional Sports Team',
            ],
            [
                'category_name' => 'Profile',
            ],
            [
                'category_name' => 'Promenade',
            ],
            [
                'category_name' => 'Property Lawyer',
            ],
            [
                'category_name' => 'Property Management Company',
            ],
            [
                'category_name' => 'Prosthodontist',
            ],
            [
                'category_name' => 'Province',
            ],
            [
                'category_name' => 'Psychiatrist',
            ],
            [
                'category_name' => 'Psychologist',
            ],
            [
                'category_name' => 'Psychotherapist',
            ],
            [
                'category_name' => 'Pub',
            ],
            [
                'category_name' => 'Public & Government Service',
            ],
            [
                'category_name' => 'Public Figure',
            ],
            [
                'category_name' => 'Public Garden',
            ],
            [
                'category_name' => 'Public School',
            ],
            [
                'category_name' => 'Public Service',
            ],
            [
                'category_name' => 'Public Square / Plaza',
            ],
            [
                'category_name' => 'Public Swimming Pool',
            ],
            [
                'category_name' => 'Public Toilet',
            ],
            [
                'category_name' => 'Public Utility Company',
            ],
            [
                'category_name' => 'Publisher',
            ],
            [
                'category_name' => 'Puerto Rican Restaurant',
            ],
            [
                'category_name' => 'Puglia Restaurant',
            ],
            [
                'category_name' => 'Pulmonologist',
            ],
            [
                'category_name' => 'Punjabi Restaurant',
            ],
            [
                'category_name' => 'Quay',
            ],
            [
                'category_name' => 'Racquetball Court',
            ],
            [
                'category_name' => 'Radio Station',
            ],
            [
                'category_name' => 'Radiologist',
            ],
            [
                'category_name' => 'Rafting/Kayaking Center',
            ],
            [
                'category_name' => 'Railroad Company',
            ],
            [
                'category_name' => 'Railway Station',
            ],
            [
                'category_name' => 'Rajasthani Restaurant',
            ],
            [
                'category_name' => 'Ramen Restaurant',
            ],
            [
                'category_name' => 'Real Estate',
            ],
            [
                'category_name' => 'Real Estate Agent',
            ],
            [
                'category_name' => 'Real Estate Appraiser',
            ],
            [
                'category_name' => 'Real Estate Company',
            ],
            [
                'category_name' => 'Real Estate Developer',
            ],
            [
                'category_name' => 'Real Estate Investment Firm',
            ],
            [
                'category_name' => 'Real Estate Lawyer',
            ],
            [
                'category_name' => 'Real Estate Service',
            ],
            [
                'category_name' => 'Real Estate Title & Development',
            ],
            [
                'category_name' => 'Record Label',
            ],
            [
                'category_name' => 'Recreation & Sports Website',
            ],
            [
                'category_name' => 'Recreation Center',
            ],
            [
                'category_name' => 'Recreation Spot',
            ],
            [
                'category_name' => 'Recruiter',
            ],
            [
                'category_name' => 'Recycling Center',
            ],
            [
                'category_name' => 'Reference Website',
            ],
            [
                'category_name' => 'Reflexologist',
            ],
            [
                'category_name' => 'Refrigeration Service',
            ],
            [
                'category_name' => 'Region',
            ],
            [
                'category_name' => 'Regional Website',
            ],
            [
                'category_name' => 'Religious Bookstore',
            ],
            [
                'category_name' => 'Religious Center',
            ],
            [
                'category_name' => 'Religious Organization',
            ],
            [
                'category_name' => 'Religious Place of Worship',
            ],
            [
                'category_name' => 'Religious School',
            ],
            [
                'category_name' => 'Rent to Own Store',
            ],
            [
                'category_name' => 'Rental Shop',
            ],
            [
                'category_name' => 'Reproductive Service',
            ],
            [
                'category_name' => 'Reptile Pet Store',
            ],
            [
                'category_name' => 'Reservoir',
            ],
            [
                'category_name' => 'Residence',
            ],
            [
                'category_name' => 'Restaurant',
            ],
            [
                'category_name' => 'Restaurant Supply Store',
            ],
            [
                'category_name' => 'Restaurant Wholesaler',
            ],
            [
                'category_name' => 'Retail Bank',
            ],
            [
                'category_name' => 'Retail Company',
            ],
            [
                'category_name' => 'Retirement & Assisted Living Facility',
            ],
            [
                'category_name' => 'Rheumatologist',
            ],
            [
                'category_name' => 'Rideshare Service',
            ],
            [
                'category_name' => 'River',
            ],
            [
                'category_name' => 'Robotics Company',
            ],
            [
                'category_name' => 'Rock Climbing Gym',
            ],
            [
                'category_name' => 'Rock Climbing Spot',
            ],
            [
                'category_name' => 'Rodeo',
            ],
            [
                'category_name' => 'Roller Skating Rink',
            ],
            [
                'category_name' => 'Roman Restaurant',
            ],
            [
                'category_name' => 'Romanian Restaurant',
            ],
            [
                'category_name' => 'Roofing Service',
            ],
            [
                'category_name' => 'Rose Garden',
            ],
            [
                'category_name' => 'Rugby Pitch',
            ],
            [
                'category_name' => 'Rugby Stadium',
            ],
            [
                'category_name' => 'Russian Restaurant',
            ],
            [
                'category_name' => 'RV Park',
            ],
            [
                'category_name' => 'RV Rental',
            ],
            [
                'category_name' => 'RV Repair Shop',
            ],
            [
                'category_name' => 'Safety & First Aid Service',
            ],
            [
                'category_name' => 'Sake Bar',
            ],
            [
                'category_name' => 'Salad Bar',
            ],
            [
                'category_name' => 'Salvadoran Restaurant',
            ],
            [
                'category_name' => 'Samgyetang Restaurant',
            ],
            [
                'category_name' => 'Sandblasting Service',
            ],
            [
                'category_name' => 'Sandwich Shop',
            ],
            [
                'category_name' => 'Sardinian Restaurant',
            ],
            [
                'category_name' => 'Satire/Parody',
            ],
            [
                'category_name' => 'Saxon Restaurant',
            ],
            [
                'category_name' => 'Scandinavian Restaurant',
            ],
            [
                'category_name' => 'School',
            ],
            [
                'category_name' => 'School Fundraiser',
            ],
            [
                'category_name' => 'School Sports League',
            ],
            [
                'category_name' => 'School Sports Team',
            ],
            [
                'category_name' => 'School Transportation Service',
            ],
            [
                'category_name' => 'Science',
            ],
            [
                'category_name' => 'Science Website',
            ],
            [
                'category_name' => 'Science, Technology & Engineering',
            ],
            [
                'category_name' => 'Scientist',
            ],
            [
                'category_name' => 'Scooter Rental',
            ],
            [
                'category_name' => 'Scottish Restaurant',
            ],
            [
                'category_name' => 'Screen Printing & Embroidery',
            ],
            [
                'category_name' => 'Scuba Diving Center',
            ],
            [
                'category_name' => 'Scuba Instructor',
            ],
            [
                'category_name' => 'Sculpture Garden',
            ],
            [
                'category_name' => 'Seafood Restaurant',
            ],
            [
                'category_name' => 'Seaplane Base',
            ],
            [
                'category_name' => 'Seasonal Store',
            ],
            [
                'category_name' => 'Secretarial Service',
            ],
            [
                'category_name' => 'Security Guard Service',
            ],
            [
                'category_name' => 'Self-Storage Facility',
            ],
            [
                'category_name' => 'Senegalese Restaurant',
            ],
            [
                'category_name' => 'Senior Center',
            ],
            [
                'category_name' => 'Septic Tank Service',
            ],
            [
                'category_name' => 'Service Apartments',
            ],
            [
                'category_name' => 'Seventh Day Adventist Church',
            ],
            [
                'category_name' => 'Sewer Service',
            ],
            [
                'category_name' => 'Sewing & Alterations',
            ],
            [
                'category_name' => 'Sex Therapist',
            ],
            [
                'category_name' => 'Shaanxi Restaurant',
            ],
            [
                'category_name' => 'Shabu Shabu Restaurant',
            ],
            [
                'category_name' => 'Shandong Restaurant',
            ],
            [
                'category_name' => 'Shanghainese Restaurant',
            ],
            [
                'category_name' => 'Shanxi Restaurant',
            ],
            [
                'category_name' => 'Shaved Ice Shop',
            ],
            [
                'category_name' => 'Shipping Supply & Service',
            ],
            [
                'category_name' => 'Shoe Repair Shop',
            ],
            [
                'category_name' => 'Shooting/Hunting Range',
            ],
            [
                'category_name' => 'Shopping & Retail',
            ],
            [
                'category_name' => 'Shopping District',
            ],
            [
                'category_name' => 'Shopping Mall',
            ],
            [
                'category_name' => 'Shopping Service',
            ],
            [
                'category_name' => 'Show',
            ],
            [
                'category_name' => 'Shredding Service',
            ],
            [
                'category_name' => 'Sicilian Restaurant',
            ],
            [
                'category_name' => 'Sightseeing Tour Agency',
            ],
            [
                'category_name' => 'Signs & Banner Service',
            ],
            [
                'category_name' => 'Sikh Temple',
            ],
            [
                'category_name' => 'Singaporean Restaurant',
            ],
            [
                'category_name' => 'Skate Shop',
            ],
            [
                'category_name' => 'Skateboard Park',
            ],
            [
                'category_name' => 'Ski & Snowboard School',
            ],
            [
                'category_name' => 'Ski & Snowboard Shop',
            ],
            [
                'category_name' => 'Ski Resort',
            ],
            [
                'category_name' => 'Skin Care Service',
            ],
            [
                'category_name' => 'Skydiving Center',
            ],
            [
                'category_name' => 'Slovakian Restaurant',
            ],
            [
                'category_name' => 'Small Geo Area',
            ],
            [
                'category_name' => 'Smog Emissions Check Station',
            ],
            [
                'category_name' => 'Smoothie & Juice Bar',
            ],
            [
                'category_name' => 'Snorkeling Spot',
            ],
            [
                'category_name' => 'Soba Restaurant',
            ],
            [
                'category_name' => 'Soccer Field',
            ],
            [
                'category_name' => 'Soccer Stadium',
            ],
            [
                'category_name' => 'Social Club',
            ],
            [
                'category_name' => 'Social Media Company',
            ],
            [
                'category_name' => 'Social Service',
            ],
            [
                'category_name' => 'Society & Culture Website',
            ],
            [
                'category_name' => 'Software',
            ],
            [
                'category_name' => 'Software Company',
            ],
            [
                'category_name' => 'Solar Energy Company',
            ],
            [
                'category_name' => 'Solar Energy Service',
            ],
            [
                'category_name' => 'Song',
            ],
            [
                'category_name' => 'Sorority & Fraternity',
            ],
            [
                'category_name' => 'Soul Food Restaurant',
            ],
            [
                'category_name' => 'Soup Restaurant',
            ],
            [
                'category_name' => 'South African Restaurant',
            ],
            [
                'category_name' => 'South Indian Restaurant',
            ],
            [
                'category_name' => 'South Tyrolean Restaurant',
            ],
            [
                'category_name' => 'Southern Restaurant',
            ],
            [
                'category_name' => 'Southwestern Restaurant',
            ],
            [
                'category_name' => 'Souvenir Shop',
            ],
            [
                'category_name' => 'Spa',
            ],
            [
                'category_name' => 'Spanish Restaurant',
            ],
            [
                'category_name' => 'Speakeasy',
            ],
            [
                'category_name' => 'Specialty Grocery Store',
            ],
            [
                'category_name' => 'Specialty School',
            ],
            [
                'category_name' => 'Speech Pathologist',
            ],
            [
                'category_name' => 'Speech Therapist',
            ],
            [
                'category_name' => 'Spiritual Leader',
            ],
            [
                'category_name' => 'Sport Psychologist',
            ],
            [
                'category_name' => 'Sporting Goods Store',
            ],
            [
                'category_name' => 'Sports',
            ],
            [
                'category_name' => 'Sports & Fitness Instruction',
            ],
            [
                'category_name' => 'Sports & Recreation',
            ],
            [
                'category_name' => 'Sports & Recreation Venue',
            ],
            [
                'category_name' => 'Sports Bar',
            ],
            [
                'category_name' => 'Sports Club',
            ],
            [
                'category_name' => 'Sports Event',
            ],
            [
                'category_name' => 'Sports League',
            ],
            [
                'category_name' => 'Sports Promoter',
            ],
            [
                'category_name' => 'Sports Season',
            ],
            [
                'category_name' => 'Sports Team',
            ],
            [
                'category_name' => 'Sportswear Store',
            ],
            [
                'category_name' => 'Squash Court',
            ],
            [
                'category_name' => 'Sri Lankan Restaurant',
            ],
            [
                'category_name' => 'Stadium, Arena & Sports Venue',
            ],
            [
                'category_name' => 'State',
            ],
            [
                'category_name' => 'State Park',
            ],
            [
                'category_name' => 'Stately Home',
            ],
            [
                'category_name' => 'Statue & Fountain',
            ],
            [
                'category_name' => 'STD Testing Center',
            ],
            [
                'category_name' => 'Steakhouse',
            ],
            [
                'category_name' => 'Storage Facility',
            ],
            [
                'category_name' => 'Street',
            ],
            [
                'category_name' => 'Structural Engineer',
            ],
            [
                'category_name' => 'Subcity',
            ],
            [
                'category_name' => 'Subneighborhood',
            ],
            [
                'category_name' => 'Subway Station',
            ],
            [
                'category_name' => 'Sugaring Service',
            ],
            [
                'category_name' => 'Sukiyaki Restaurant',
            ],
            [
                'category_name' => 'Sundanese Restaurant',
            ],
            [
                'category_name' => 'Sunglasses & Eyewear Store',
            ],
            [
                'category_name' => 'Supermarket',
            ],
            [
                'category_name' => 'Surf Shop',
            ],
            [
                'category_name' => 'Surfing Spot',
            ],
            [
                'category_name' => 'Surgeon',
            ],
            [
                'category_name' => 'Surgeries',
            ],
            [
                'category_name' => 'Surgical Center',
            ],
            [
                'category_name' => 'Surveyor',
            ],
            [
                'category_name' => 'Sushi Restaurant',
            ],
            [
                'category_name' => 'Swabian Restaurant',
            ],
            [
                'category_name' => 'Swimming Instructor',
            ],
            [
                'category_name' => 'Swimming Pool & Hot Tub Service',
            ],
            [
                'category_name' => 'Swimming Pool Cleaner',
            ],
            [
                'category_name' => 'Swimwear Store',
            ],
            [
                'category_name' => 'Swiss Restaurant',
            ],
            [
                'category_name' => 'Symphony',
            ],
            [
                'category_name' => 'Synagogue',
            ],
            [
                'category_name' => 'Syrian Restaurant',
            ],
            [
                'category_name' => 'Szechuan/Sichuan Restaurant',
            ],
            [
                'category_name' => 'Taco Restaurant',
            ],
            [
                'category_name' => 'Tai Chi Studio',
            ],
            [
                'category_name' => 'Taiwanese Restaurant',
            ],
            [
                'category_name' => 'Takoyaki Restaurant',
            ],
            [
                'category_name' => 'Talent Agent',
            ],
            [
                'category_name' => 'Tamilian Restaurant',
            ],
            [
                'category_name' => 'Tanning Salon',
            ],
            [
                'category_name' => 'Tapas Bar & Restaurant',
            ],
            [
                'category_name' => 'Tatar Restaurant',
            ],
            [
                'category_name' => 'Tattoo & Piercing Shop',
            ],
            [
                'category_name' => 'Tax Lawyer',
            ],
            [
                'category_name' => 'Tax Preparation Service',
            ],
            [
                'category_name' => 'Taxi Service',
            ],
            [
                'category_name' => 'Taxidermist',
            ],
            [
                'category_name' => 'Tea Room',
            ],
            [
                'category_name' => 'Teens & Kids Website',
            ],
            [
                'category_name' => 'Teeth Whitening Service',
            ],
            [
                'category_name' => 'Telecommunication Company',
            ],
            [
                'category_name' => 'Television Repair Service',
            ],
            [
                'category_name' => 'Television Service Provider',
            ],
            [
                'category_name' => 'Tempura Restaurant',
            ],
            [
                'category_name' => 'Tennis Court',
            ],
            [
                'category_name' => 'Tennis Stadium',
            ],
            [
                'category_name' => 'Teppanyaki Restaurant',
            ],
            [
                'category_name' => 'Test Preparation Center',
            ],
            [
                'category_name' => 'Tex-Mex Restaurant',
            ],
            [
                'category_name' => 'Textile Company',
            ],
            [
                'category_name' => 'Thai Restaurant',
            ],
            [
                'category_name' => 'Theatrical Play',
            ],
            [
                'category_name' => 'Theatrical Productions',
            ],
            [
                'category_name' => 'Theme Restaurant',
            ],
            [
                'category_name' => 'Therapist',
            ],
            [
                'category_name' => 'Threading Service',
            ],
            [
                'category_name' => 'Thrift & Consignment Store',
            ],
            [
                'category_name' => 'Tianjin Restaurant',
            ],
            [
                'category_name' => 'Ticket Sales',
            ],
            [
                'category_name' => 'Tiki Bar',
            ],
            [
                'category_name' => 'Tiling Service',
            ],
            [
                'category_name' => 'Time zone',
            ],
            [
                'category_name' => 'Tire Dealer & Repair Shop',
            ],
            [
                'category_name' => 'Tobacco Cessation Treatment Center',
            ],
            [
                'category_name' => 'Tobacco Company',
            ],
            [
                'category_name' => 'Tobacco Store',
            ],
            [
                'category_name' => 'Tonkatsu Restaurant',
            ],
            [
                'category_name' => 'Tools/Equipment',
            ],
            [
                'category_name' => 'Topic',
            ],
            [
                'category_name' => 'Tour Agency',
            ],
            [
                'category_name' => 'Tour Guide',
            ],
            [
                'category_name' => 'Tourist Information Center',
            ],
            [
                'category_name' => 'Towing Service',
            ],
            [
                'category_name' => 'Township',
            ],
            [
                'category_name' => 'Toy Store',
            ],
            [
                'category_name' => 'Track Stadium',
            ],
            [
                'category_name' => 'Trade School',
            ],
            [
                'category_name' => 'Traffic School',
            ],
            [
                'category_name' => 'Trailer Rental',
            ],
            [
                'category_name' => 'Train Station',
            ],
            [
                'category_name' => 'Transit Hub',
            ],
            [
                'category_name' => 'Transit Stop',
            ],
            [
                'category_name' => 'Transit System',
            ],
            [
                'category_name' => 'Translator',
            ],
            [
                'category_name' => 'Transportation Service',
            ],
            [
                'category_name' => 'Travel & Transportation',
            ],
            [
                'category_name' => 'Travel Agency',
            ],
            [
                'category_name' => 'Travel Company',
            ],
            [
                'category_name' => 'Travel Service',
            ],
            [
                'category_name' => 'Tree Cutting Service',
            ],
            [
                'category_name' => 'Trentino Alto Adige Restaurant',
            ],
            [
                'category_name' => 'Trinidadian Restaurant',
            ],
            [
                'category_name' => 'Trophies & Engraving Shop',
            ],
            [
                'category_name' => 'Truck Rental',
            ],
            [
                'category_name' => 'Truck Repair Shop',
            ],
            [
                'category_name' => 'Turkish Restaurant',
            ],
            [
                'category_name' => 'Tuscan Restaurant',
            ],
            [
                'category_name' => 'Tutor/Teacher',
            ],
            [
                'category_name' => 'TV',
            ],
            [
                'category_name' => 'TV & Movies',
            ],
            [
                'category_name' => 'TV Channel',
            ],
            [
                'category_name' => 'TV Genre',
            ],
            [
                'category_name' => 'TV Network',
            ],
            [
                'category_name' => 'TV Season',
            ],
            [
                'category_name' => 'TV Show',
            ],
            [
                'category_name' => 'TV/Movie Award',
            ],
            [
                'category_name' => 'Udon Restaurant',
            ],
            [
                'category_name' => 'Udupi Restaurant',
            ],
            [
                'category_name' => 'Ukrainian Restaurant',
            ],
            [
                'category_name' => 'Umbrian Restaurant',
            ],
            [
                'category_name' => 'Unagi Restaurant',
            ],
            [
                'category_name' => 'Uniform Supplier',
            ],
            [
                'category_name' => 'University (NCES)',
            ],
            [
                'category_name' => 'University Status',
            ],
            [
                'category_name' => 'Urologist',
            ],
            [
                'category_name' => 'Uruguayan Restaurant',
            ],
            [
                'category_name' => 'Uttar Pradesh Restaurant',
            ],
            [
                'category_name' => 'Uzbek Restaurant',
            ],
            [
                'category_name' => 'Vacation Home Rental',
            ],
            [
                'category_name' => 'Vegetarian/Vegan Restaurant',
            ],
            [
                'category_name' => 'Vending Machine Sales & Service',
            ],
            [
                'category_name' => 'Venetian Restaurant',
            ],
            [
                'category_name' => 'Venezuelan Restaurant',
            ],
            [
                'category_name' => 'Veterinarian',
            ],
            [
                'category_name' => 'Video',
            ],
            [
                'category_name' => 'Video Creator',
            ],
            [
                'category_name' => 'Video Game',
            ],
            [
                'category_name' => 'Video Game Store',
            ],
            [
                'category_name' => 'Vietnamese Restaurant',
            ],
            [
                'category_name' => 'Village',
            ],
            [
                'category_name' => 'Vintage Store',
            ],
            [
                'category_name' => 'Vinyl Siding Company',
            ],
            [
                'category_name' => 'Visual Arts',
            ],
            [
                'category_name' => 'Vitamin Supplement Shop',
            ],
            [
                'category_name' => 'Vitamins/Supplements',
            ],
            [
                'category_name' => 'Volcano',
            ],
            [
                'category_name' => 'Volleyball Court',
            ],
            [
                'category_name' => 'Wagashi Restaurant',
            ],
            [
                'category_name' => 'Waste Management Company',
            ],
            [
                'category_name' => 'Water Heater Installation & Repair Service',
            ],
            [
                'category_name' => 'Water Treatment Service',
            ],
            [
                'category_name' => 'Water Utility Company',
            ],
            [
                'category_name' => 'Waterfall',
            ],
            [
                'category_name' => 'Waxing Service',
            ],
            [
                'category_name' => 'Weather Station',
            ],
            [
                'category_name' => 'Web Designer',
            ],
            [
                'category_name' => 'Website',
            ],
            [
                'category_name' => 'Wedding Planning Service',
            ],
            [
                'category_name' => 'Wedding Venue',
            ],
            [
                'category_name' => 'Weight Loss Center',
            ],
            [
                'category_name' => 'Well Water Drilling Service',
            ],
            [
                'category_name' => 'Wheel & Rim Repair Service',
            ],
            [
                'category_name' => 'Whisky Bar',
            ],
            [
                'category_name' => 'Wholesale & Supply Store',
            ],
            [
                'category_name' => 'Wholesale Bakery',
            ],
            [
                'category_name' => 'Wholesale Grocer',
            ],
            [
                'category_name' => 'Wig Store',
            ],
            [
                'category_name' => 'Window Installation Service',
            ],
            [
                'category_name' => 'Wine Bar',
            ],
            [
                'category_name' => 'Wine, Beer & Spirits Store',
            ],
            [
                'category_name' => 'Wine/Spirits',
            ],
            [
                'category_name' => 'Winery/Vineyard',
            ],
            [
                'category_name' => 'Women\'s Clothing Store',
            ],
            [
                'category_name' => 'Women\'s Health Clinic',
            ],
            [
                'category_name' => 'Work Position',
            ],
            [
                'category_name' => 'Work Project',
            ],
            [
                'category_name' => 'Work Status',
            ],
            [
                'category_name' => 'Writer',
            ],
            [
                'category_name' => 'Writing Service',
            ],
            [
                'category_name' => 'Xinjiang Restaurant',
            ],
            [
                'category_name' => 'Yakiniku Restaurant',
            ],
            [
                'category_name' => 'Yakitori Restaurant',
            ],
            [
                'category_name' => 'Yoga Studio',
            ],
            [
                'category_name' => 'Yoshoku Restaurant',
            ],
            [
                'category_name' => 'Youth Organization',
            ],
            [
                'category_name' => 'Yunnan Restaurant',
            ],
            [
                'category_name' => 'Zhejiang Restaurant',
            ],
        ];

        foreach ($categories as $category) {
            FacebookCategory::create([
                'facebook_category_name' => $category['category_name'],
                'created_at' => Carbon::now()
            ]);
        }
    }
}
