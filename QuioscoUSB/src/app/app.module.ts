import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';

import { AppComponent } from './app.component';
import { SidebarComponent } from './sidebar/sidebar.component';
import { ViewContentComponent } from './view-content/view-content.component';
import { NewsComponent } from './news/news.component';
import { PlanesDeEstudioComponent } from './planes-de-estudio/planes-de-estudio.component';
import { DirectoryComponent } from './directory/directory.component';
import { MapComponent } from './map/map.component';
import { CourseFinderComponent } from './course-finder/course-finder.component';
import { FindCourseService } from "app/services/find-course.service";
import { DirectoryService } from "app/services/directory.service";
import { PlanesDeEstudioService } from "app/services/planes-de-estudio.service";
import { Utilities } from "app/utilities";
import { ServicesUtilities } from "app/services/services-utilities";

@NgModule({
  declarations: [
    AppComponent,
    SidebarComponent,
    ViewContentComponent,
    NewsComponent,
    PlanesDeEstudioComponent,
    DirectoryComponent,
    MapComponent,
    CourseFinderComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule
  ],
  providers: [FindCourseService,DirectoryService,PlanesDeEstudioService,Utilities,ServicesUtilities],
  bootstrap: [AppComponent]
})
export class AppModule { }
