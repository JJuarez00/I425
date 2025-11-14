/**
 * Author: Joseph Juarez
 * Date: 11/11/2025
 * File: professors.jsx
 * Description: Display details of a specific professor.
 */

import {settings} from "../../config/config";
import useXmlHttp from '../../services/useXmlHttp';
import {useParams, Link, useOutletContext, Outlet} from "react-router-dom";
import "../../assets/css/professor.css";

const Professor = () => {
    const [subheading, setSubHeading] = useOutletContext();
    const {professorId} = useParams();
    const url = settings.baseApiUrl + "/professors/" + professorId;
    const {
        error,
        isLoading,
        data: professor
    } = useXmlHttp(url);
    return (
        <>
            {error && <div>{error}</div>}
            {isLoading &&
                <div className="image-loading">
                    Please wait while data is being loaded
                    <img src="/src/assets/img/loading.gif" alt="Loading ......"/>
                </div>}
            {professor && <>
                {setSubHeading(professor.name)}
                <div className="professor-details">
                    <div className="professor-name">{professor.name}</div>

                    <div className="professor-info">
                        <div><strong>Department</strong>: {professor.department}</div>
                        <div><strong>Program</strong>: {professor.program}</div>
                        <div><strong>Email</strong>: {professor.email}</div>
                        <div><strong>Phone</strong>: {professor.phone}</div>
                        <div><strong>Office</strong>: {professor.office}</div>
                        <div><strong>Profile</strong>:<a href={professor.url} target="_blank">Click here to view profile</a></div>
                        <div><strong>Classes</strong>: <Link to={`/professors/${professor.id}/classes`}>Click here to view classes</Link></div>
                    </div>

                    <div className="professor-photo">
                        <img src={professor.image} alt={professor.name} id={professor.id}/>
                    </div>

                </div>

                <div className="professor-classes">
                    <Outlet/>
                </div>

            </>}
        </>
    );
};

export default Professor;