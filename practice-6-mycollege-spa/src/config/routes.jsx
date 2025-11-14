/**
 * Author: Joseph Juarez
 * Date: 11/05/2025
 * File: routes.jsx
 * Description: Defines app routes.
 */

import {BrowserRouter,Routes,Route}from "react-router-dom";
import Layout from "../components/Layout";
import Home from "../pages/home";
import NoMatch from "../pages/nomatch";
import Professors from "../pages/professor/professors.jsx";
import Professor from "../pages/professor/professor.jsx";

const AppRoutes = () => {
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Layout/>}>
                    <Route index element={<Home/>}/>

                    <Route path="professors" element={<Professors/>}>
                        <Route index element={<p>Select a professor to view details.</p>}/>
                        <Route path=":professorId" element={<Professor/>} />
                    </Route>
                    <Route path="*" element={<NoMatch/>}/>
                </Route>
            </Routes>
        </BrowserRouter>
    );
};

export default AppRoutes;