<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Afghanistan', 'code' => 'AF'],
            ['name' => 'Albania', 'code' => 'AL'],
            ['name' => 'Algeria', 'code' => 'DZ'],
            ['name' => 'American Samoa', 'code' => 'AS'],
            ['name' => 'Andorra', 'code' => 'AD'],
            ['name' => 'Angola', 'code' => 'AO'],
            ['name' => 'Anguilla', 'code' => 'AI'],
            ['name' => 'Antarctica', 'code' => 'AQ'],
            ['name' => 'Antigua and Barbuda', 'code' => 'AG'],
            ['name' => 'Argentina', 'code' => 'AR'],
            ['name' => 'Armenia', 'code' => 'AM'],
            ['name' => 'Aruba', 'code' => 'AW'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'Austria', 'code' => 'AT'],
            ['name' => 'Azerbaijan', 'code' => 'AZ'],
            ['name' => 'Bahamas', 'code' => 'BS'],
            ['name' => 'Bahrain', 'code' => 'BH'],
            ['name' => 'Bangladesh', 'code' => 'BD'],
            ['name' => 'Barbados', 'code' => 'BB'],
            ['name' => 'Belarus', 'code' => 'BY'],
            ['name' => 'Belgium', 'code' => 'BE'],
            ['name' => 'Belize', 'code' => 'BZ'],
            ['name' => 'Benin', 'code' => 'BJ'],
            ['name' => 'Bermuda', 'code' => 'BM'],
            ['name' => 'Bhutan', 'code' => 'BT'],
            ['name' => 'Bolivia', 'code' => 'BO'],
            ['name' => 'Bosnia and Herzegovina', 'code' => 'BA'],
            ['name' => 'Botswana', 'code' => 'BW'],
            ['name' => 'Brazil', 'code' => 'BR'],
            ['name' => 'Brunei Darussalam', 'code' => 'BN'],
            ['name' => 'Bulgaria', 'code' => 'BG'],
            ['name' => 'Burkina Faso', 'code' => 'BF'],
            ['name' => 'Burundi', 'code' => 'BI'],
            ['name' => 'Cambodia', 'code' => 'KH'],
            ['name' => 'Cameroon', 'code' => 'CM'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'Cape Verde', 'code' => 'CV'],
            ['name' => 'Cayman Islands', 'code' => 'KY'],
            ['name' => 'Central African Republic', 'code' => 'CF'],
            ['name' => 'Chad', 'code' => 'TD'],
            ['name' => 'Chile', 'code' => 'CL'],
            ['name' => 'China', 'code' => 'CN'],
            ['name' => 'Colombia', 'code' => 'CO'],
            ['name' => 'Comoros', 'code' => 'KM'],
            ['name' => 'Congo', 'code' => 'CG'],
            ['name' => 'Congo, The Democratic Republic of the', 'code' => 'CD'],
            ['name' => 'Costa Rica', 'code' => 'CR'],
            ['name' => 'Croatia', 'code' => 'HR'],
            ['name' => 'Cuba', 'code' => 'CU'],
            ['name' => 'Cyprus', 'code' => 'CY'],
            ['name' => 'Czech Republic', 'code' => 'CZ'],
            ['name' => 'Denmark', 'code' => 'DK'],
            ['name' => 'Djibouti', 'code' => 'DJ'],
            ['name' => 'Dominica', 'code' => 'DM'],
            ['name' => 'Dominican Republic', 'code' => 'DO'],
            ['name' => 'Ecuador', 'code' => 'EC'],
            ['name' => 'Egypt', 'code' => 'EG'],
            ['name' => 'El Salvador', 'code' => 'SV'],
            ['name' => 'Estonia', 'code' => 'EE'],
            ['name' => 'Ethiopia', 'code' => 'ET'],
            ['name' => 'Fiji', 'code' => 'FJ'],
            ['name' => 'Finland', 'code' => 'FI'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'Rwanda', 'code' => 'RW'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'Ghana', 'code' => 'GH'],
            ['name' => 'Greece', 'code' => 'GR'],
            ['name' => 'Hungary', 'code' => 'HU'],
            ['name' => 'Iceland', 'code' => 'IS'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'Indonesia', 'code' => 'ID'],
        ];

        Country::insert($countries);
    }
}
