/*
Name: Joseph Juarez
Date: 11/04/2025
File: Layout.js
Description: create the page layout.
*/

import {Outlet} from "react-router-dom";
import Header from "./Header";
import Footer from "./Footer";

const Layout = () => {
    return (
        <>
            <Header/>
            <Outlet />
            <Footer />
        </>
    );
};

export default Layout;
