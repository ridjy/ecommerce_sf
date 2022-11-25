import React from 'react';
import Banner from './Banner';
import Product from './Product';

function Home(){
    return (
        <div>
            <Banner />
            <Product name="test"/>   
        </div>
    )
}

export default Home