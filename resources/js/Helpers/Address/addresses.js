import barangay from './barangay.json';
import city from './city.json';
import province from './province.json';
import region from './region.json';


export class Address {
    constructor(zone, brgy, city, province, region) {
        this.brgy = brgy;
        this.city = city;
        this.province = province;
        this.region = region;
        this.zone = zone;

        this.brgy_name = null;
        this.city_name = null;
        this.region_name = null;
        this.province_name = null;

        this.getBarangayName()
        this.getCityName()
        this.getProvinceName()
        this.getRegionName()
    }

    getBarangayName = () => {
        const selectedBarangay = barangay.filter(data => {
            return data.brgy_code == this.brgy
        });
        return selectedBarangay.length > 0 ? this.brgy_name = selectedBarangay[0].brgy_name : null;
    }
    getCityName = () => {
        const selectedCity = city.filter(data => {
            return data.city_code == this.city
        });
        return selectedCity.length > 0 ? 
        this.city_name = selectedCity[0].city_name :
        null;
    }
    getProvinceName = () => {
        const selectedProvince = province.filter(data => {
            return data.province_code == this.province
        });
        return selectedProvince.length > 0 ? this.province_name = selectedProvince[0].province_name : null;
    }

    getRegionName = () => {
        const selectedRegion = region.filter(data => {
            return data.region_code == this.region
        });
        return selectedRegion.length > 0 ? this.region_name = selectedRegion[0].region_name : null;
    }

    getFullAddress = () => {
        return `${this.zone}, ${this.brgy_name}, ${this.city_name}, ${this.province_name}, ${this.region_name}`
    }
}

export const getProvinces = (region_code) => {
    return province.filter(pr => pr.region_code === region_code);
}
