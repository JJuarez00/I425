/**
 * Author: Joseph Juarez
 * Date: 11/05/2025
 * File: professors.jsx
 * Description: Create a component to list all professors.
 */

import {settings} from "../../config/config";
import {useState, useEffect} from 'react';
import {NavLink, useLocation} from "react-router-dom";
import "../../assets/css/professor.css";

const Professors = () => {
    const {pathname} = useLocation();
    const [subHeading, setSubHeading] = useState("All Professors");
    const url = settings.baseApiUrl + "/professors";
    const [professors, setProfessors] = useState(null);
    const [error, setError] = useState(null);
    const [isLoading, setIsLoading] = useState(true);

    // useEffect hook – fetch all professors from API.
    useEffect(() => {
        let request = new XMLHttpRequest();
        request.open("GET", url, true);
        request.timeout = 2000; // Time in milliseconds.
        request.onload = () => { // Request finished.
            setIsLoading (false)
            if (request.status === 200) {
                setProfessors(JSON.parse(request.response));
            } else {
                setError("Status: " + request.status + "; Error: " + request.statusText);
            }
        }
        request.ontimeout = () => { // Request timed out.
            setIsLoading (false);
            setError("Error: The request has timed out.");
        }
        request.send();
    });

    // Update subheading when the route changes.
    useEffect(() => {
        setSubHeading("All Professors");
    }, [pathname]);

    return (
        <div>

            {/* Displays the main page title “Professor”*/}
            <div className="main-heading">
                <div className="container">Professor</div>
            </div>

            {/* Displays the current subheading, for example “All Professors” */}
            <div className="sub-heading">
                <div className="container">{subHeading}</div>
            </div>

            {/* Displays loading image, error message, or the professor list */}
            <div className="main-content container">

                {/* --- Error Message --- */}
                {error && <div>{error}</div>}

                {/* --- Loading State --- */}
                {isLoading && <div className="image-loading">
                    Please wait while data is being loaded
                    <img src="/src/assets/img/loading.gif" alt="Loading ......"/>
                </div>}

                {/* --- Professor List --- */}
                {professors && <div className="professor-container">

                    {/* Left side: clickable list of professors */}
                    <div className="professor-list">
                        {professors.map((professor) => (
                            <NavLink key={professor.id}
                                     className={({isActive}) => isActive ? "active" : ""}
                                     to="#">
                                <span>&nbsp;</span><div>{professor.name}</div>
                            </NavLink>
                        ))}
                    </div>

                    {/* Right side: placeholder area for professor details */}
                    <div className="professor-item">
                        Professor details
                    </div>
                </div>}
            </div>

        </div>
    );
};

export default Professors;