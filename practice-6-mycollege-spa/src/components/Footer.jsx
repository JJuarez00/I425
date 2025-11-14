/*
Name: Joseph Juarez
Date: 11/04/2025
File: Footer.js
Description: create a common page footer
*/

const Footer = () => {
    const year = new Date().getFullYear();  //determine the current year with JavaScript
    return (
        <footer>
            <div className="container">
                <span>&copy;MyCollege Corporation. 2017-{year}</span>
            </div>
        </footer>
    );
};

export default Footer;
