/**
 * Author: Joseph Juarez
 * Date: 11/11/2025
 * File: classes.jsx
 * Description: Display classes taught by a professor.
 */

import {settings} from "../../config/config";
import useXmlHttp from '../../services/useXmlHttp';
import {useParams} from "react-router-dom";
import '../../assets/css/class.css';
import {useAuth} from "../../services/useAuth";

const Classes = () => {

    const {user} = useAuth();

    const {professorId} = useParams();
    const url = settings.baseApiUrl + "/professors/" + professorId + "/classes";
    const {
        error,
        isLoading,
        data: classes
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    return (
        <>
            {error && <div>{error}</div>}

            {isLoading &&
                <div className="image-loading">
                    Please wait while data is being loaded
                    <img src="/src/assets/img/loading.gif" alt="Loading ......"/>
                </div>}

            {classes && (classes.length === 0
                    ? <p>Classes were not found.</p>
                    : <div className="class-row class-row-header">
                        <div>Course</div>
                        <div>Section</div>
                        <div>Semester</div>
                        <div>Year</div>
                    </div>
            )}

            {classes && (
                classes.map((cls, index) => ( //cannot use "class" as a variable name. "class" is a reserved word/
                    <div key={index} className="class-row">
                        <div>{cls.course}</div>
                        <div>{cls.section}</div>
                        <div>{cls.semester}</div>
                        <div>{cls.year}</div>
                    </div>
                ))
            )}

        </>
    );
};

export default Classes;