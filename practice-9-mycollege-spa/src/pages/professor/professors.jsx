/**
 * Author: Joseph Juarez
 * Date: 11/05/2025
 * File: professors.jsx
 * Description: Create a component to list all professors.
 */

import {settings} from "../../config/config";
import {useState, useEffect} from 'react';
import {NavLink, Outlet, useLocation} from "react-router-dom";
import "../../assets/css/professor.css";
import useXmlHttp from "../../services/useXmlHttp";
import {useAuth} from "../../services/useAuth";

const Professors = () => {

    const {user} = useAuth();

    const {pathname} = useLocation();
    const [subHeading, setSubHeading] = useState("All Professors");
    const url = settings.baseApiUrl + "/professors";
    const {
        error,
        isLoading,
        data: professors
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

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
                                     to={`/professors/${professor.id}`}>
                                <span>&nbsp;</span><div>{professor.name}</div>
                            </NavLink>
                        ))}
                    </div>

                    {/* Right side: Professor details */}
                    <div className="professor-item">
                        <Outlet context={[subHeading, setSubHeading]}/>
                    </div>

                </div>}
            </div>

        </div>
    );
};

export default Professors;