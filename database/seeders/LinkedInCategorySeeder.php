<?php

namespace Database\Seeders;

use App\Models\LinkedInCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkedInCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'industry_code' => '2190',
                'industry_label' => 'Accommodation Services',
            ],
            [
                'industry_code' => '34',
                'industry_label' => 'Food and Beverage Services',
            ],
            [
                'industry_code' => '2217',
                'industry_label' => 'Bars, Taverns, and Nightclubs',
            ],
            [
                'industry_code' => '2212',
                'industry_label' => 'Caterers',
            ],
            [
                'industry_code' => '2214',
                'industry_label' => 'Mobile Food Services',
            ],
            [
                'industry_code' => '32',
                'industry_label' => 'Restaurants',
            ],
            [
                'industry_code' => '31',
                'industry_label' => 'Hospitality',
            ],
            [
                'industry_code' => '2197',
                'industry_label' => 'Bed-and-Breakfasts, Hostels, Homestays',
            ],
            [
                'industry_code' => '2194',
                'industry_label' => 'Hotels and Motels',
            ],
            [
                'industry_code' => '1912',
                'industry_label' => 'Administrative and Support Services',
            ],
            [
                'industry_code' => '1938',
                'industry_label' => 'Collection Agencies',
            ],
            [
                'industry_code' => '110',
                'industry_label' => 'Events Services',
            ],
            [
                'industry_code' => '122',
                'industry_label' => 'Facilities Services',
            ],
            [
                'industry_code' => '1965',
                'industry_label' => 'Janitorial Services',
            ],
            [
                'industry_code' => '2934',
                'industry_label' => 'Landscaping Services',
            ],
            [
                'industry_code' => '101',
                'industry_label' => 'Fundraising',
            ],
            [
                'industry_code' => '1916',
                'industry_label' => 'Office Administration',
            ],
            [
                'industry_code' => '121',
                'industry_label' => 'Security and Investigations',
            ],
            [
                'industry_code' => '1956',
                'industry_label' => 'Security Guards and Patrol Services',
            ],
            [
                'industry_code' => '1958',
                'industry_label' => 'Security Systems Services',
            ],
            [
                'industry_code' => '104',
                'industry_label' => 'Staffing and Recruiting',
            ],
            [
                'industry_code' => '1923',
                'industry_label' => 'Executive Search Services',
            ],
            [
                'industry_code' => '1925',
                'industry_label' => 'Temporary Help Services',
            ],
            [
                'industry_code' => '1931',
                'industry_label' => 'Telephone Call Centers',
            ],
            [
                'industry_code' => '108',
                'industry_label' => 'Translation and Localization',
            ],
            [
                'industry_code' => '30',
                'industry_label' => 'Travel Arrangements',
            ],
            [
                'industry_code' => '103',
                'industry_label' => 'Writing and Editing',
            ],
            [
                'industry_code' => '48',
                'industry_label' => 'Construction',
            ],
            [
                'industry_code' => '406',
                'industry_label' => 'Building Construction',
            ],
            [
                'industry_code' => '413',
                'industry_label' => 'Nonresidential Building Construction',
            ],
            [
                'industry_code' => '408',
                'industry_label' => 'Residential Building Construction',
            ],
            [
                'industry_code' => '51',
                'industry_label' => 'Civil Engineering',
            ],
            [
                'industry_code' => '431',
                'industry_label' => 'Highway, Street, and Bridge Construction',
            ],
            [
                'industry_code' => '428',
                'industry_label' => 'Subdivision of Land',
            ],
            [
                'industry_code' => '419',
                'industry_label' => 'Utility System Construction',
            ],
            [
                'industry_code' => '435',
                'industry_label' => 'Specialty Trade Contractors',
            ],
            [
                'industry_code' => '453',
                'industry_label' => 'Building Equipment Contractors',
            ],
            [
                'industry_code' => '460',
                'industry_label' => 'Building Finishing Contractors',
            ],
            [
                'industry_code' => '436',
                'industry_label' => 'Building Structure and Exterior Contractors',
            ],
            [
                'industry_code' => '91',
                'industry_label' => 'Consumer Services',
            ],
            [
                'industry_code' => '90',
                'industry_label' => 'Civic and Social Organizations',
            ],
            [
                'industry_code' => '1909',
                'industry_label' => 'Industry Associations',
            ],
            [
                'industry_code' => '107',
                'industry_label' => 'Political Organizations',
            ],
            [
                'industry_code' => '1911',
                'industry_label' => 'Professional Organizations',
            ],
            [
                'industry_code' => '2318',
                'industry_label' => 'Household Services',
            ],
            [
                'industry_code' => '100',
                'industry_label' => 'Non-profit Organizations',
            ],
            [
                'industry_code' => '2258',
                'industry_label' => 'Personal and Laundry Services',
            ],
            [
                'industry_code' => '2272',
                'industry_label' => 'Laundry and Drycleaning Services',
            ],
            [
                'industry_code' => '2259',
                'industry_label' => 'Personal Care Services',
            ],
            [
                'industry_code' => '2282',
                'industry_label' => 'Pet Services',
            ],
            [
                'industry_code' => '131',
                'industry_label' => 'Philanthropic Fundraising Services',
            ],
            [
                'industry_code' => '89',
                'industry_label' => 'Religious Institutions',
            ],
            [
                'industry_code' => '2225',
                'industry_label' => 'Repair and Maintenance',
            ],
            [
                'industry_code' => '2247',
                'industry_label' => 'Commercial and Industrial Machinery Maintenance',
            ],
            [
                'industry_code' => '2240',
                'industry_label' => 'Electronic and Precision Equipment Maintenance',
            ],
            [
                'industry_code' => '2255',
                'industry_label' => 'Footwear and Leather Goods Repair',
            ],
            [
                'industry_code' => '2253',
                'industry_label' => 'Reupholstery and Furniture Repair',
            ],
            [
                'industry_code' => '2226',
                'industry_label' => 'Vehicle Repair and Maintenance',
            ],
            [
                'industry_code' => '1999',
                'industry_label' => 'Education',
            ],
            [
                'industry_code' => '132',
                'industry_label' => 'E-Learning Providers',
            ],
            [
                'industry_code' => '68',
                'industry_label' => 'Higher Education',
            ],
            [
                'industry_code' => '67',
                'industry_label' => 'Primary and Secondary Education',
            ],
            [
                'industry_code' => '105',
                'industry_label' => 'Professional Training and Coaching',
            ],
            [
                'industry_code' => '2018',
                'industry_label' => 'Technical and Vocational Training',
            ],
            [
                'industry_code' => '2019',
                'industry_label' => 'Cosmetology and Barber Schools',
            ],
            [
                'industry_code' => '2025',
                'industry_label' => 'Fine Arts Schools',
            ],
            [
                'industry_code' => '2020',
                'industry_label' => 'Flight Training',
            ],
            [
                'industry_code' => '2029',
                'industry_label' => 'Language Schools',
            ],
            [
                'industry_code' => '2012',
                'industry_label' => 'Secretarial Schools',
            ],
            [
                'industry_code' => '2027',
                'industry_label' => 'Sports and Recreation Instruction',
            ],
            [
                'industry_code' => '28',
                'industry_label' => 'Entertainment Providers',
            ],
            [
                'industry_code' => '38',
                'industry_label' => 'Artists and Writers',
            ],
            [
                'industry_code' => '37',
                'industry_label' => 'Museums, Historical Sites, and Zoos',
            ],
            [
                'industry_code' => '2161',
                'industry_label' => 'Historical Sites',
            ],
            [
                'industry_code' => '2159',
                'industry_label' => 'Museums',
            ],
            [
                'industry_code' => '2163',
                'industry_label' => 'Zoos and Botanical Gardens',
            ],
            [
                'industry_code' => '115',
                'industry_label' => 'Musicians',
            ],
            [
                'industry_code' => '2130',
                'industry_label' => 'Performing Arts and Spectator Sports',
            ],
            [
                'industry_code' => '2139',
                'industry_label' => 'Circuses and Magic Shows',
            ],
            [
                'industry_code' => '2135',
                'industry_label' => 'Dance Companies',
            ],
            [
                'industry_code' => '39',
                'industry_label' => 'Performing Arts',
            ],
            [
                'industry_code' => '33',
                'industry_label' => 'Spectator Sports',
            ],
            [
                'industry_code' => '2143',
                'industry_label' => 'Racetracks',
            ],
            [
                'industry_code' => '2142',
                'industry_label' => 'Sports Teams and Clubs',
            ],
            [
                'industry_code' => '2133',
                'industry_label' => 'Theater Companies',
            ],
            [
                'industry_code' => '40',
                'industry_label' => 'Recreational Facilities',
            ],
            [
                'industry_code' => '2167',
                'industry_label' => 'Amusement Parks and Arcades',
            ],
            [
                'industry_code' => '29',
                'industry_label' => 'Gambling Facilities and Casinos',
            ],
            [
                'industry_code' => '2179',
                'industry_label' => 'Golf Courses and Country Clubs',
            ],
            [
                'industry_code' => '2181',
                'industry_label' => 'Skiing Facilities',
            ],
            [
                'industry_code' => '124',
                'industry_label' => 'Wellness and Fitness Services',
            ],
            [
                'industry_code' => '201',
                'industry_label' => 'Farming, Ranching, Forestry',
            ],
            [
                'industry_code' => '63',
                'industry_label' => 'Farming',
            ],
            [
                'industry_code' => '150',
                'industry_label' => 'Horticulture',
            ],
            [
                'industry_code' => '298',
                'industry_label' => 'Forestry and Logging',
            ],
            [
                'industry_code' => '256',
                'industry_label' => 'Ranching and Fisheries',
            ],
            [
                'industry_code' => '66',
                'industry_label' => 'Fisheries',
            ],
            [
                'industry_code' => '64',
                'industry_label' => 'Ranching',
            ],
            [
                'industry_code' => '43',
                'industry_label' => 'Financial Services',
            ],
            [
                'industry_code' => '129',
                'industry_label' => 'Capital Markets',
            ],
            [
                'industry_code' => '1720',
                'industry_label' => 'Investment Advice',
            ],
            [
                'industry_code' => '45',
                'industry_label' => 'Investment Banking',
            ],
            [
                'industry_code' => '46',
                'industry_label' => 'Investment Management',
            ],
            [
                'industry_code' => '1713',
                'industry_label' => 'Securities and Commodity Exchanges',
            ],
            [
                'industry_code' => '106',
                'industry_label' => 'Venture Capital and Private Equity Principals',
            ],
            [
                'industry_code' => '1673',
                'industry_label' => 'Credit Intermediation',
            ],
            [
                'industry_code' => '41',
                'industry_label' => 'Banking',
            ],
            [
                'industry_code' => '141',
                'industry_label' => 'International Trade and Development',
            ],
            [
                'industry_code' => '1696',
                'industry_label' => 'Loan Brokers',
            ],
            [
                'industry_code' => '1678',
                'industry_label' => 'Savings Institutions',
            ],
            [
                'industry_code' => '1742',
                'industry_label' => 'Funds and Trusts',
            ],
            [
                'industry_code' => '1743',
                'industry_label' => 'Insurance and Employee Benefit Funds',
            ],
            [
                'industry_code' => '1745',
                'industry_label' => 'Pension Funds',
            ],
            [
                'industry_code' => '1750',
                'industry_label' => 'Trusts and Estates',
            ],
            [
                'industry_code' => '42',
                'industry_label' => 'Insurance',
            ],
            [
                'industry_code' => '1738',
                'industry_label' => 'Claims Adjusting, Actuarial Services',
            ],
            [
                'industry_code' => '1737',
                'industry_label' => 'Insurance Agencies and Brokerages',
            ],
            [
                'industry_code' => '1725',
                'industry_label' => 'Insurance Carriers',
            ],
            [
                'industry_code' => '75',
                'industry_label' => 'Government Administration',
            ],
            [
                'industry_code' => '73',
                'industry_label' => 'Administration of Justice',
            ],
            [
                'industry_code' => '3068',
                'industry_label' => 'Correctional Institutions',
            ],
            [
                'industry_code' => '3065',
                'industry_label' => 'Courts of Law',
            ],
            [
                'industry_code' => '3070',
                'industry_label' => 'Fire Protection',
            ],
            [
                'industry_code' => '77',
                'industry_label' => 'Law Enforcement',
            ],
            [
                'industry_code' => '78',
                'industry_label' => 'Public Safety',
            ],
            [
                'industry_code' => '2375',
                'industry_label' => 'Economic Programs',
            ],
            [
                'industry_code' => '3085',
                'industry_label' => 'Transportation Programs',
            ],
            [
                'industry_code' => '3086',
                'industry_label' => 'Utilities Administration',
            ],
            [
                'industry_code' => '388',
                'industry_label' => 'Environmental Quality Programs',
            ],
            [
                'industry_code' => '2366',
                'industry_label' => 'Air, Water, and Waste Program Management',
            ],
            [
                'industry_code' => '2368',
                'industry_label' => 'Conservation Programs',
            ],
            [
                'industry_code' => '2353',
                'industry_label' => 'Health and Human Services',
            ],
            [
                'industry_code' => '69',
                'industry_label' => 'Education Administration Programs',
            ],
            [
                'industry_code' => '2360',
                'industry_label' => 'Public Assistance Programs',
            ],
            [
                'industry_code' => '2358',
                'industry_label' => 'Public Health',
            ],
            [
                'industry_code' => '2369',
                'industry_label' => 'Housing and Community Development',
            ],
            [
                'industry_code' => '2374',
                'industry_label' => 'Community Development and Urban Planning',
            ],
            [
                'industry_code' => '3081',
                'industry_label' => 'Housing Programs',
            ],
            [
                'industry_code' => '2391',
                'industry_label' => 'Military and International Affairs',
            ],
            [
                'industry_code' => '71',
                'industry_label' => 'Armed Forces',
            ],
            [
                'industry_code' => '74',
                'industry_label' => 'International Affairs',
            ],
            [
                'industry_code' => '79',
                'industry_label' => 'Public Policy Offices',
            ],
            [
                'industry_code' => '76',
                'industry_label' => 'Executive Offices',
            ],
            [
                'industry_code' => '72',
                'industry_label' => 'Legislative Offices',
            ],
            [
                'industry_code' => '3089',
                'industry_label' => 'Space Research and Technology',
            ],
            [
                'industry_code' => '1905',
                'industry_label' => 'Holding Companies',
            ],
            [
                'industry_code' => '14',
                'industry_label' => 'Hospitals and Health Care',
            ],
            [
                'industry_code' => '2115',
                'industry_label' => 'Community Services',
            ],
            [
                'industry_code' => '2112',
                'industry_label' => 'Services for the Elderly and Disabled',
            ],
            [
                'industry_code' => '2081',
                'industry_label' => 'Hospitals',
            ],
            [
                'industry_code' => '88',
                'industry_label' => 'Individual and Family Services',
            ],
            [
                'industry_code' => '2128',
                'industry_label' => 'Child Day Care Services',
            ],
            [
                'industry_code' => '2122',
                'industry_label' => 'Emergency and Relief Services',
            ],
            [
                'industry_code' => '2125',
                'industry_label' => 'Vocational Rehabilitation Services',
            ],
            [
                'industry_code' => '13',
                'industry_label' => 'Medical Practices',
            ],
            [
                'industry_code' => '125',
                'industry_label' => 'Alternative Medicine',
            ],
            [
                'industry_code' => '2077',
                'industry_label' => 'Ambulance Services',
            ],
            [
                'industry_code' => '2048',
                'industry_label' => 'Chiropractors',
            ],
            [
                'industry_code' => '2045',
                'industry_label' => 'Dentists',
            ],
            [
                'industry_code' => '2060',
                'industry_label' => 'Family Planning Centers',
            ],
            [
                'industry_code' => '2074',
                'industry_label' => 'Home Health Care Services',
            ],
            [
                'industry_code' => '2069',
                'industry_label' => 'Medical and Diagnostic Laboratories',
            ],
            [
                'industry_code' => '139',
                'industry_label' => 'Mental Health Care',
            ],
            [
                'industry_code' => '2050',
                'industry_label' => 'Optometrists',
            ],
            [
                'industry_code' => '2063',
                'industry_label' => 'Outpatient Care Centers',
            ],
            [
                'industry_code' => '2054',
                'industry_label' => 'Physical, Occupational and Speech Therapists',
            ],
            [
                'industry_code' => '2040',
                'industry_label' => 'Physicians',
            ],
            [
                'industry_code' => '2091',
                'industry_label' => 'Nursing Homes and Residential Care Facilities',
            ],
            [
                'industry_code' => '25',
                'industry_label' => 'Manufacturing',
            ],
            [
                'industry_code' => '598',
                'industry_label' => 'Apparel Manufacturing',
            ],
            [
                'industry_code' => '615',
                'industry_label' => 'Fashion Accessories Manufacturing',
            ],
            [
                'industry_code' => '112',
                'industry_label' => 'Appliances, Electrical, and Electronics Manufacturing',
            ],
            [
                'industry_code' => '998',
                'industry_label' => 'Electric Lighting Equipment Manufacturing',
            ],
            [
                'industry_code' => '2468',
                'industry_label' => 'Electrical Equipment Manufacturing',
            ],
            [
                'industry_code' => '3255',
                'industry_label' => 'Fuel Cell Manufacturing',
            ],
            [
                'industry_code' => '1005',
                'industry_label' => 'Household Appliance Manufacturing',
            ],
            [
                'industry_code' => '54',
                'industry_label' => 'Chemical Manufacturing',
            ],
            [
                'industry_code' => '709',
                'industry_label' => 'Agricultural Chemical Manufacturing',
            ],
            [
                'industry_code' => '703',
                'industry_label' => 'Artificial Rubber and Synthetic Fiber Manufacturing',
            ],
            [
                'industry_code' => '690',
                'industry_label' => 'Chemical Raw Materials Manufacturing',
            ],
            [
                'industry_code' => '722',
                'industry_label' => 'Paint, Coating, and Adhesive Manufacturing',
            ],
            [
                'industry_code' => '18',
                'industry_label' => 'Personal Care Product Manufacturing',
            ],
            [
                'industry_code' => '15',
                'industry_label' => 'Pharmaceutical Manufacturing',
            ],
            [
                'industry_code' => '727',
                'industry_label' => 'Soap and Cleaning Product Manufacturing',
            ],
            [
                'industry_code' => '3251',
                'industry_label' => 'Climate Technology Product Manufacturing',
            ],
            [
                'industry_code' => '24',
                'industry_label' => 'Computers and Electronics Manufacturing',
            ],
            [
                'industry_code' => '973',
                'industry_label' => 'Audio and Video Equipment Manufacturing',
            ],
            [
                'industry_code' => '964',
                'industry_label' => 'Communications Equipment Manufacturing',
            ],
            [
                'industry_code' => '3',
                'industry_label' => 'Computer Hardware Manufacturing',
            ],
            [
                'industry_code' => '3245',
                'industry_label' => 'Accessible Hardware Manufacturing',
            ],
            [
                'industry_code' => '994',
                'industry_label' => 'Magnetic and Optical Media Manufacturing',
            ],
            [
                'industry_code' => '983',
                'industry_label' => 'Measuring and Control Instrument Manufacturing',
            ],
            [
                'industry_code' => '3254',
                'industry_label' => 'Smart Meter Manufacturing',
            ],
            [
                'industry_code' => '7',
                'industry_label' => 'Semiconductor Manufacturing',
            ],
            [
                'industry_code' => '144',
                'industry_label' => 'Renewable Energy Semiconductor Manufacturing',
            ],
            [
                'industry_code' => '840',
                'industry_label' => 'Fabricated Metal Products',
            ],
            [
                'industry_code' => '852',
                'industry_label' => 'Architectural and Structural Metal Manufacturing',
            ],
            [
                'industry_code' => '861',
                'industry_label' => 'Boilers, Tanks, and Shipping Container Manufacturing',
            ],
            [
                'industry_code' => '871',
                'industry_label' => 'Construction Hardware Manufacturing',
            ],
            [
                'industry_code' => '849',
                'industry_label' => 'Cutlery and Handtool Manufacturing',
            ],
            [
                'industry_code' => '883',
                'industry_label' => 'Metal Treatments',
            ],
            [
                'industry_code' => '887',
                'industry_label' => 'Metal Valve, Ball, and Roller Manufacturing',
            ],
            [
                'industry_code' => '873',
                'industry_label' => 'Spring and Wire Product Manufacturing',
            ],
            [
                'industry_code' => '876',
                'industry_label' => 'Turned Products and Fastener Manufacturing',
            ],
            [
                'industry_code' => '23',
                'industry_label' => 'Food and Beverage Manufacturing',
            ],
            [
                'industry_code' => '562',
                'industry_label' => 'Breweries',
            ],
            [
                'industry_code' => '564',
                'industry_label' => 'Distilleries',
            ],
            [
                'industry_code' => '2500',
                'industry_label' => 'Wineries',
            ],
            [
                'industry_code' => '481',
                'industry_label' => 'Animal Feed Manufacturing',
            ],
            [
                'industry_code' => '529',
                'industry_label' => 'Baked Goods Manufacturing',
            ],
            [
                'industry_code' => '142',
                'industry_label' => 'Beverage Manufacturing',
            ],
            [
                'industry_code' => '65',
                'industry_label' => 'Dairy Product Manufacturing',
            ],
            [
                'industry_code' => '504',
                'industry_label' => 'Fruit and Vegetable Preserves Manufacturing',
            ],
            [
                'industry_code' => '521',
                'industry_label' => 'Meat Products Manufacturing',
            ],
            [
                'industry_code' => '528',
                'industry_label' => 'Seafood Product Manufacturing',
            ],
            [
                'industry_code' => '495',
                'industry_label' => 'Sugar and Confectionery Product Manufacturing',
            ],
            [
                'industry_code' => '26',
                'industry_label' => 'Furniture and Home Furnishings Manufacturing',
            ],
            [
                'industry_code' => '1080',
                'industry_label' => 'Household and Institutional Furniture Manufacturing',
            ],
            [
                'industry_code' => '1095',
                'industry_label' => 'Mattress and Blinds Manufacturing',
            ],
            [
                'industry_code' => '1090',
                'industry_label' => 'Office Furniture and Fixtures Manufacturing',
            ],
            [
                'industry_code' => '145',
                'industry_label' => 'Glass, Ceramics and Concrete Manufacturing',
            ],
            [
                'industry_code' => '799',
                'industry_label' => 'Abrasives and Nonmetallic Minerals Manufacturing',
            ],
            [
                'industry_code' => '773',
                'industry_label' => 'Clay and Refractory Products Manufacturing',
            ],
            [
                'industry_code' => '779',
                'industry_label' => 'Glass Product Manufacturing',
            ],
            [
                'industry_code' => '794',
                'industry_label' => 'Lime and Gypsum Products Manufacturing',
            ],
            [
                'industry_code' => '616',
                'industry_label' => 'Leather Product Manufacturing',
            ],
            [
                'industry_code' => '622',
                'industry_label' => 'Footwear Manufacturing',
            ],
            [
                'industry_code' => '625',
                'industry_label' => 'Women\'s Handbag Manufacturing',
            ],
            [
                'industry_code' => '55',
                'industry_label' => 'Machinery Manufacturing',
            ],
            [
                'industry_code' => '901',
                'industry_label' => 'Agriculture, Construction, Mining Machinery Manufacturing',
            ],
            [
                'industry_code' => '147',
                'industry_label' => 'Automation Machinery Manufacturing',
            ],
            [
                'industry_code' => '3247',
                'industry_label' => 'Robot Manufacturing',
            ],
            [
                'industry_code' => '918',
                'industry_label' => 'Commercial and Service Industry Machinery Manufacturing',
            ],
            [
                'industry_code' => '935',
                'industry_label' => 'Engines and Power Transmission Equipment Manufacturing',
            ],
            [
                'industry_code' => '3241',
                'industry_label' => 'Renewable Energy Equipment Manufacturing',
            ],
            [
                'industry_code' => '923',
                'industry_label' => 'HVAC and Refrigeration Equipment Manufacturing',
            ],
            [
                'industry_code' => '135',
                'industry_label' => 'Industrial Machinery Manufacturing',
            ],
            [
                'industry_code' => '928',
                'industry_label' => 'Metalworking Machinery Manufacturing',
            ],
            [
                'industry_code' => '17',
                'industry_label' => 'Medical Equipment Manufacturing',
            ],
            [
                'industry_code' => '679',
                'industry_label' => 'Oil and Coal Product Manufacturing',
            ],
            [
                'industry_code' => '61',
                'industry_label' => 'Paper and Forest Product Manufacturing',
            ],
            [
                'industry_code' => '743',
                'industry_label' => 'Plastics and Rubber Product Manufacturing',
            ],
            [
                'industry_code' => '146',
                'industry_label' => 'Packaging and Containers Manufacturing',
            ],
            [
                'industry_code' => '117',
                'industry_label' => 'Plastics Manufacturing',
            ],
            [
                'industry_code' => '763',
                'industry_label' => 'Rubber Products Manufacturing',
            ],
            [
                'industry_code' => '807',
                'industry_label' => 'Primary Metal Manufacturing',
            ],
            [
                'industry_code' => '83',
                'industry_label' => 'Printing Services',
            ],
            [
                'industry_code' => '20',
                'industry_label' => 'Sporting Goods Manufacturing',
            ],
            [
                'industry_code' => '60',
                'industry_label' => 'Textile Manufacturing',
            ],
            [
                'industry_code' => '21',
                'industry_label' => 'Tobacco Manufacturing',
            ],
            [
                'industry_code' => '1029',
                'industry_label' => 'Transportation Equipment Manufacturing',
            ],
            [
                'industry_code' => '52',
                'industry_label' => 'Aviation and Aerospace Component Manufacturing',
            ],
            [
                'industry_code' => '1',
                'industry_label' => 'Defense and Space Manufacturing',
            ],
            [
                'industry_code' => '53',
                'industry_label' => 'Motor Vehicle Manufacturing',
            ],
            [
                'industry_code' => '3253',
                'industry_label' => 'Alternative Fuel Vehicle Manufacturing',
            ],
            [
                'industry_code' => '1042',
                'industry_label' => 'Motor Vehicle Parts Manufacturing',
            ],
            [
                'industry_code' => '62',
                'industry_label' => 'Railroad Equipment Manufacturing',
            ],
            [
                'industry_code' => '58',
                'industry_label' => 'Shipbuilding',
            ],
            [
                'industry_code' => '784',
                'industry_label' => 'Wood Product Manufacturing',
            ],
            [
                'industry_code' => '332',
                'industry_label' => 'Oil, Gas, and Mining',
            ],
            [
                'industry_code' => '56',
                'industry_label' => 'Mining',
            ],
            [
                'industry_code' => '341',
                'industry_label' => 'Coal Mining',
            ],
            [
                'industry_code' => '345',
                'industry_label' => 'Metal Ore Mining',
            ],
            [
                'industry_code' => '356',
                'industry_label' => 'Nonmetallic Mineral Mining',
            ],
            [
                'industry_code' => '57',
                'industry_label' => 'Oil and Gas',
            ],
            [
                'industry_code' => '3096',
                'industry_label' => 'Natural Gas Extraction',
            ],
            [
                'industry_code' => '3095',
                'industry_label' => 'Oil Extraction',
            ],
            [
                'industry_code' => '1810',
                'industry_label' => 'Professional Services',
            ],
            [
                'industry_code' => '47',
                'industry_label' => 'Accounting',
            ],
            [
                'industry_code' => '80',
                'industry_label' => 'Advertising Services',
            ],
            [
                'industry_code' => '148',
                'industry_label' => 'Government Relations Services',
            ],
            [
                'industry_code' => '98',
                'industry_label' => 'Public Relations and Communications Services',
            ],
            [
                'industry_code' => '97',
                'industry_label' => 'Market Research',
            ],
            [
                'industry_code' => '50',
                'industry_label' => 'Architecture and Planning',
            ],
            [
                'industry_code' => '3246',
                'industry_label' => 'Accessible Architecture and Design',
            ],
            [
                'industry_code' => '11',
                'industry_label' => 'Business Consulting and Services',
            ],
            [
                'industry_code' => '86',
                'industry_label' => 'Environmental Services',
            ],
            [
                'industry_code' => '137',
                'industry_label' => 'Human Resources Services',
            ],
            [
                'industry_code' => '1862',
                'industry_label' => 'Marketing Services',
            ],
            [
                'industry_code' => '2401',
                'industry_label' => 'Operations Consulting',
            ],
            [
                'industry_code' => '123',
                'industry_label' => 'Outsourcing and Offshoring Consulting',
            ],
            [
                'industry_code' => '102',
                'industry_label' => 'Strategic Management Services',
            ],
            [
                'industry_code' => '99',
                'industry_label' => 'Design Services',
            ],
            [
                'industry_code' => '140',
                'industry_label' => 'Graphic Design',
            ],
            [
                'industry_code' => '3256',
                'industry_label' => 'Regenerative Design',
            ],
            [
                'industry_code' => '3126',
                'industry_label' => 'Interior Design',
            ],
            [
                'industry_code' => '3242',
                'industry_label' => 'Engineering Services',
            ],
            [
                'industry_code' => '3248',
                'industry_label' => 'Robotics Engineering',
            ],
            [
                'industry_code' => '3249',
                'industry_label' => 'Surveying and Mapping Services',
            ],
            [
                'industry_code' => '96',
                'industry_label' => 'IT Services and IT Consulting',
            ],
            [
                'industry_code' => '118',
                'industry_label' => 'Computer and Network Security',
            ],
            [
                'industry_code' => '3244',
                'industry_label' => 'Digital Accessibility Services',
            ],
            [
                'industry_code' => '3102',
                'industry_label' => 'IT System Custom Software Development',
            ],
            [
                'industry_code' => '3106',
                'industry_label' => 'IT System Data Services',
            ],
            [
                'industry_code' => '1855',
                'industry_label' => 'IT System Design Services',
            ],
            [
                'industry_code' => '3104',
                'industry_label' => 'IT System Installation and Disposal',
            ],
            [
                'industry_code' => '3103',
                'industry_label' => 'IT System Operations and Maintenance',
            ],
            [
                'industry_code' => '3107',
                'industry_label' => 'IT System Testing and Evaluation',
            ],
            [
                'industry_code' => '3105',
                'industry_label' => 'IT System Training and Support',
            ],
            [
                'industry_code' => '10',
                'industry_label' => 'Legal Services',
            ],
            [
                'industry_code' => '120',
                'industry_label' => 'Alternative Dispute Resolution',
            ],
            [
                'industry_code' => '9',
                'industry_label' => 'Law Practice',
            ],
            [
                'industry_code' => '136',
                'industry_label' => 'Photography',
            ],
            [
                'industry_code' => '70',
                'industry_label' => 'Research Services',
            ],
            [
                'industry_code' => '12',
                'industry_label' => 'Biotechnology Research',
            ],
            [
                'industry_code' => '114',
                'industry_label' => 'Nanotechnology Research',
            ],
            [
                'industry_code' => '130',
                'industry_label' => 'Think Tanks',
            ],
            [
                'industry_code' => '3243',
                'industry_label' => 'Services for Renewable Energy',
            ],
            [
                'industry_code' => '16',
                'industry_label' => 'Veterinary Services',
            ],
            [
                'industry_code' => '1757',
                'industry_label' => 'Real Estate and Equipment Rental Services',
            ],
            [
                'industry_code' => '1779',
                'industry_label' => 'Equipment Rental Services',
            ],
            [
                'industry_code' => '1798',
                'industry_label' => 'Commercial and Industrial Equipment Rental',
            ],
            [
                'industry_code' => '1786',
                'industry_label' => 'Consumer Goods Rental',
            ],
            [
                'industry_code' => '44',
                'industry_label' => 'Real Estate',
            ],
            [
                'industry_code' => '128',
                'industry_label' => 'Leasing Non-residential Real Estate',
            ],
            [
                'industry_code' => '1759',
                'industry_label' => 'Leasing Residential Real Estate',
            ],
            [
                'industry_code' => '1770',
                'industry_label' => 'Real Estate Agents and Brokers',
            ],
            [
                'industry_code' => '27',
                'industry_label' => 'Retail',
            ],
            [
                'industry_code' => '1339',
                'industry_label' => 'Food and Beverage Retail',
            ],
            [
                'industry_code' => '22',
                'industry_label' => 'Retail Groceries',
            ],
            [
                'industry_code' => '1445',
                'industry_label' => 'Online and Mail Order Retail',
            ],
            [
                'industry_code' => '19',
                'industry_label' => 'Retail Apparel and Fashion',
            ],
            [
                'industry_code' => '1319',
                'industry_label' => 'Retail Appliances, Electrical, and Electronic Equipment',
            ],
            [
                'industry_code' => '3186',
                'industry_label' => 'Retail Art Dealers',
            ],
            [
                'industry_code' => '111',
                'industry_label' => 'Retail Art Supplies',
            ],
            [
                'industry_code' => '1409',
                'industry_label' => 'Retail Books and Printed News',
            ],
            [
                'industry_code' => '1324',
                'industry_label' => 'Retail Building Materials and Garden Equipment',
            ],
            [
                'industry_code' => '1423',
                'industry_label' => 'Retail Florists',
            ],
            [
                'industry_code' => '1309',
                'industry_label' => 'Retail Furniture and Home Furnishings',
            ],
            [
                'industry_code' => '1370',
                'industry_label' => 'Retail Gasoline',
            ],
            [
                'industry_code' => '1359',
                'industry_label' => 'Retail Health and Personal Care Products',
            ],
            [
                'industry_code' => '3250',
                'industry_label' => 'Retail Pharmacies',
            ],
            [
                'industry_code' => '143',
                'industry_label' => 'Retail Luxury Goods and Jewelry',
            ],
            [
                'industry_code' => '1292',
                'industry_label' => 'Retail Motor Vehicles',
            ],
            [
                'industry_code' => '1407',
                'industry_label' => 'Retail Musical Instruments',
            ],
            [
                'industry_code' => '138',
                'industry_label' => 'Retail Office Equipment',
            ],
            [
                'industry_code' => '1424',
                'industry_label' => 'Retail Office Supplies and Gifts',
            ],
            [
                'industry_code' => '1431',
                'industry_label' => 'Retail Recyclable Materials & Used Merchandise',
            ],
            [
                'industry_code' => '1594',
                'industry_label' => 'Technology, Information and Media',
            ],
            [
                'industry_code' => '3133',
                'industry_label' => 'Media & Telecommunications',
            ],
            [
                'industry_code' => '82',
                'industry_label' => 'Book and Periodical Publishing',
            ],
            [
                'industry_code' => '1602',
                'industry_label' => 'Book Publishing',
            ],
            [
                'industry_code' => '81',
                'industry_label' => 'Newspaper Publishing',
            ],
            [
                'industry_code' => '1600',
                'industry_label' => 'Periodical Publishing',
            ],
            [
                'industry_code' => '36',
                'industry_label' => 'Broadcast Media Production and Distribution',
            ],
            [
                'industry_code' => '1641',
                'industry_label' => 'Cable and Satellite Programming',
            ],
            [
                'industry_code' => '1633',
                'industry_label' => 'Radio and Television Broadcasting',
            ],
            [
                'industry_code' => '35',
                'industry_label' => 'Movies, Videos and Sound',
            ],
            [
                'industry_code' => '127',
                'industry_label' => 'Animation and Post-production',
            ],
            [
                'industry_code' => '126',
                'industry_label' => 'Media Production',
            ],
            [
                'industry_code' => '1611',
                'industry_label' => 'Movies and Sound Recording',
            ],
            [
                'industry_code' => '1623',
                'industry_label' => 'Sound Recording',
            ],
            [
                'industry_code' => '1625',
                'industry_label' => 'Sheet Music Publishing',
            ],
            [
                'industry_code' => '8',
                'industry_label' => 'Telecommunications',
            ],
            [
                'industry_code' => '1649',
                'industry_label' => 'Satellite Telecommunications',
            ],
            [
                'industry_code' => '1644',
                'industry_label' => 'Telecommunications Carriers',
            ],
            [
                'industry_code' => '119',
                'industry_label' => 'Wireless Services',
            ],
            [
                'industry_code' => '6',
                'industry_label' => 'Technology, Information and Internet',
            ],
            [
                'industry_code' => '2458',
                'industry_label' => 'Data Infrastructure and Analytics',
            ],
            [
                'industry_code' => '3134',
                'industry_label' => 'Blockchain Services',
            ],
            [
                'industry_code' => '3128',
                'industry_label' => 'Business Intelligence Platforms',
            ],
            [
                'industry_code' => '3252',
                'industry_label' => 'Climate Data and Analytics',
            ],
            [
                'industry_code' => '84',
                'industry_label' => 'Information Services',
            ],
            [
                'industry_code' => '3132',
                'industry_label' => 'Internet Publishing',
            ],
            [
                'industry_code' => '3129',
                'industry_label' => 'Business Content',
            ],
            [
                'industry_code' => '113',
                'industry_label' => 'Online Audio and Video Media',
            ],
            [
                'industry_code' => '3124',
                'industry_label' => 'Internet News',
            ],
            [
                'industry_code' => '85',
                'industry_label' => 'Libraries',
            ],
            [
                'industry_code' => '3125',
                'industry_label' => 'Blogs',
            ],
            [
                'industry_code' => '1285',
                'industry_label' => 'Internet Marketplace Platforms',
            ],
            [
                'industry_code' => '3127',
                'industry_label' => 'Social Networking Platforms',
            ],
            [
                'industry_code' => '4',
                'industry_label' => 'Software Development',
            ],
            [
                'industry_code' => '109',
                'industry_label' => 'Computer Games',
            ],
            [
                'industry_code' => '3131',
                'industry_label' => 'Mobile Gaming Apps',
            ],
            [
                'industry_code' => '5',
                'industry_label' => 'Computer Networking Products',
            ],
            [
                'industry_code' => '3130',
                'industry_label' => 'Data Security Software Products',
            ],
            [
                'industry_code' => '3101',
                'industry_label' => 'Desktop Computing Software Products',
            ],
            [
                'industry_code' => '3099',
                'industry_label' => 'Embedded Software Products',
            ],
            [
                'industry_code' => '3100',
                'industry_label' => 'Mobile Computing Software Products',
            ],
            [
                'industry_code' => '116',
                'industry_label' => 'Transportation, Logistics, Supply Chain and Storage',
            ],
            [
                'industry_code' => '94',
                'industry_label' => 'Airlines and Aviation',
            ],
            [
                'industry_code' => '87',
                'industry_label' => 'Freight and Package Transportation',
            ],
            [
                'industry_code' => '1495',
                'industry_label' => 'Ground Passenger Transportation',
            ],
            [
                'industry_code' => '1504',
                'industry_label' => 'Interurban and Rural Bus Services',
            ],
            [
                'industry_code' => '1512',
                'industry_label' => 'School and Employee Bus Services',
            ],
            [
                'industry_code' => '1517',
                'industry_label' => 'Shuttles and Special Needs Transportation Services',
            ],
            [
                'industry_code' => '1532',
                'industry_label' => 'Sightseeing Transportation',
            ],
            [
                'industry_code' => '1505',
                'industry_label' => 'Taxi and Limousine Services',
            ],
            [
                'industry_code' => '1497',
                'industry_label' => 'Urban Transit Services',
            ],
            [
                'industry_code' => '95',
                'industry_label' => 'Maritime Transportation',
            ],
            [
                'industry_code' => '1520',
                'industry_label' => 'Pipeline Transportation',
            ],
            [
                'industry_code' => '1573',
                'industry_label' => 'Postal Services',
            ],
            [
                'industry_code' => '1481',
                'industry_label' => 'Rail Transportation',
            ],
            [
                'industry_code' => '92',
                'industry_label' => 'Truck Transportation',
            ],
            [
                'industry_code' => '93',
                'industry_label' => 'Warehousing and Storage',
            ],
            [
                'industry_code' => '59',
                'industry_label' => 'Utilities',
            ],
            [
                'industry_code' => '383',
                'industry_label' => 'Electric Power Generation',
            ],
            [
                'industry_code' => '385',
                'industry_label' => 'Fossil Fuel Electric Power Generation',
            ],
            [
                'industry_code' => '386',
                'industry_label' => 'Nuclear Electric Power Generation',
            ],
            [
                'industry_code' => '3240',
                'industry_label' => 'Renewable Energy Power Generation',
            ],
            [
                'industry_code' => '390',
                'industry_label' => 'Biomass Electric Power Generation',
            ],
            [
                'industry_code' => '389',
                'industry_label' => 'Geothermal Electric Power Generation',
            ],
            [
                'industry_code' => '384',
                'industry_label' => 'Hydroelectric Power Generation',
            ],
            [
                'industry_code' => '387',
                'industry_label' => 'Solar Electric Power Generation',
            ],
            [
                'industry_code' => '2489',
                'industry_label' => 'Wind Electric Power Generation',
            ],
            [
                'industry_code' => '382',
                'industry_label' => 'Electric Power Transmission, Control, and Distribution',
            ],
            [
                'industry_code' => '397',
                'industry_label' => 'Natural Gas Distribution',
            ],
            [
                'industry_code' => '398',
                'industry_label' => 'Water, Waste, Steam, and Air Conditioning Services',
            ],
            [
                'industry_code' => '404',
                'industry_label' => 'Steam and Air-Conditioning Supply',
            ],
            [
                'industry_code' => '1981',
                'industry_label' => 'Waste Collection',
            ],
            [
                'industry_code' => '1986',
                'industry_label' => 'Waste Treatment and Disposal',
            ],
            [
                'industry_code' => '400',
                'industry_label' => 'Water Supply and Irrigation Systems',
            ],
            [
                'industry_code' => '133',
                'industry_label' => 'Wholesale',
            ],
            [
                'industry_code' => '1267',
                'industry_label' => 'Wholesale Alcoholic Beverages',
            ],
            [
                'industry_code' => '1222',
                'industry_label' => 'Wholesale Apparel and Sewing Supplies',
            ],
            [
                'industry_code' => '1171',
                'industry_label' => 'Wholesale Appliances, Electrical, and Electronics',
            ],
            [
                'industry_code' => '49',
                'industry_label' => 'Wholesale Building Materials',
            ],
            [
                'industry_code' => '1257',
                'industry_label' => 'Wholesale Chemical and Allied Products',
            ],
            [
                'industry_code' => '1157',
                'industry_label' => 'Wholesale Computer Equipment',
            ],
            [
                'industry_code' => '1221',
                'industry_label' => 'Wholesale Drugs and Sundries',
            ],
            [
                'industry_code' => '1231',
                'industry_label' => 'Wholesale Food and Beverage',
            ],
            [
                'industry_code' => '1230',
                'industry_label' => 'Wholesale Footwear',
            ],
            [
                'industry_code' => '1137',
                'industry_label' => 'Wholesale Furniture and Home Furnishings',
            ],
            [
                'industry_code' => '1178',
                'industry_label' => 'Wholesale Hardware, Plumbing, Heating Equipment',
            ],
            [
                'industry_code' => '134',
                'industry_label' => 'Wholesale Import and Export',
            ],
            [
                'industry_code' => '1208',
                'industry_label' => 'Wholesale Luxury Goods and Jewelry',
            ],
            [
                'industry_code' => '1187',
                'industry_label' => 'Wholesale Machinery',
            ],
            [
                'industry_code' => '1166',
                'industry_label' => 'Wholesale Metals and Minerals',
            ],
            [
                'industry_code' => '1128',
                'industry_label' => 'Wholesale Motor Vehicles and Parts',
            ],
            [
                'industry_code' => '1212',
                'industry_label' => 'Wholesale Paper Products',
            ],
            [
                'industry_code' => '1262',
                'industry_label' => 'Wholesale Petroleum and Petroleum Products',
            ],
            [
                'industry_code' => '1153',
                'industry_label' => 'Wholesale Photography Equipment and Supplies',
            ],
            [
                'industry_code' => '1250',
                'industry_label' => 'Wholesale Raw Farm Products',
            ],
            [
                'industry_code' => '1206',
                'industry_label' => 'Wholesale Recyclable Materials',
            ],
        ];

        foreach ($categories as $category) {
            LinkedInCategory::create([
                'industry_code' => $category['industry_code'],
                'industry_label' => $category['industry_label']
            ]);
        }
    }
}
